//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formRestaurante=document.querySelector("#formRestaurante");
const divFoto=document.querySelector("#divfoto");
const inputFoto=document.querySelector("#foto");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:1,
    filter:""
}
// Declaración de variables globales para mostrar la ubicación en el mapa
let map; 
let marker;

//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnNew.addEventListener("click",agregarRestaurante);
    btnCancelar.addEventListener("click",cancelarRestaurante);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input",aplicarFiltro);
    formRestaurante.addEventListener("submit",guardarRestaurante);
    divFoto.addEventListener("click",agregarFoto);
    inputFoto.addEventListener("change",actualizarFoto);
}

//Funciones

function cargarDatos() {
    API.get("restaurantes/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                initMap2();
            } else {
                console.log("Error al recuperar los registros");
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    );
}


function guardarRestaurante(event){
    event.preventDefault();
    const formData = new FormData(formRestaurante);
    //console.log(formData);
    API.post(formData,"restaurantes/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarRestaurante();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error:",error);
        }
    );
}

function actualizarFoto(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFoto() {
    inputFoto.click();
}

function aplicarFiltro (element) {
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}


function crearTabla() {
    if (objDatos.filter==""){
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(
            item=>{
                const {nombre_restaurante, direccion, telefono, contacto, fecha_ingreso, latitud, longitud}=item;
                if (nombre_restaurante.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (direccion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (telefono.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (contacto.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                /*if (foto.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }*/
                if (fecha_ingreso.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (latitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (longitud.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
            }
        );
    }

    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;

    const recordFin=(recordIni+objDatos.recordsShow)-1;

    let html="";
    objDatos.recordsFilter.forEach(
        (item,index)=>{
            if ((index>=recordIni) && (index<=recordFin)){
                        
                html+=`
                    <tr>
                    <td>${index+1}</td>
                    <td>${item.nombre_restaurante}</td>
                    <td>${item.direccion}</td>
                    <td>${item.telefono}</td>
                    <td>${item.contacto}</td>
                    <td>${item.fecha_ingreso}</td>
                    <td>${item.latitud}</td>
                    <td>${item.longitud}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarRestaurante(${item.idrestaurante})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarRestaurante(${item.idrestaurante})"><i class="fa-solid fa-trash"></i></button>
                        <button type="button" class="btn btn-info btn-ver-ubicacion" data-lat="${item.latitud}" data-lng="${item.longitud}"><i class="fa-solid fa-map"></i></button>
                    </td>
                    </tr>
                
                `;
            }
        }
    );
    //console.log(html);
    tableContent.innerHTML=html;
    crearPaginacion(); 

    document.querySelectorAll('.btn-ver-ubicacion').forEach(button => {
        button.addEventListener('click', function () {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            mostrarUbicacion(lat, lng);
        });
    });
}

// Agrega un evento click a todos los botones de ver ubicación
document.querySelectorAll('.btn-ver-ubicacion').forEach(button => {
    button.addEventListener('click', function () {
        console.log("Botón Ver Ubicación clickeado"); // Verifica si este mensaje se muestra en la consola
        const lat = parseFloat(this.dataset.lat);
        const lng = parseFloat(this.dataset.lng);
        mostrarUbicacion(lat, lng);
    });
});



// Función para mostrar la ubicación en el mapa
function mostrarUbicacion(lat, lng) {
    console.log("Mostrando ubicación en el mapa"); 
    // Centrar el mapa en las coordenadas proporcionadas
    map.setCenter({ lat: lat, lng: lng });

    // Colocar un marcador en las coordenadas proporcionadas
    if (marker) {
        marker.setPosition({ lat: lat, lng: lng });
    } else {
        marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map: map
        });
    }
}


function mostrarDatosForm(record) {
    const {idrestaurante, nombre_restaurante, direccion, telefono, contacto, foto, fecha_ingreso, latitud, longitud}=record;
    document.querySelector("#idrestaurante").value=idrestaurante;
    document.querySelector("#nombre_restaurante").value=nombre_restaurante;
    document.querySelector("#direccion").value=direccion;
    document.querySelector("#telefono").value=telefono;
    document.querySelector("#contacto").value=contacto;
    divFoto.innerHTML=`<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    document.querySelector("#fecha_ingreso").value=fecha_ingreso;
    document.querySelector("#latitud").value=latitud;
    document.querySelector("#longitud").value=longitud;

    /*.setCenter({ lat: parseFloat(latitud), lng: parseFloat(longitud) });

    // Eliminar marcador existente (si lo hay)
    if (marker) {
        marker.setMap(null);
    }

    // Colocar un nuevo marcador en las coordenadas del registro
    marker = new google.maps.Marker({
        position: { lat: parseFloat(latitud), lng: parseFloat(longitud) },
        map: map,
    });*/
}

function crearPaginacion(){
    //Borrar elementos
    pagination.innerHTML="";

    //Boton Anterior
    const elAnterior=document.createElement("li")
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Previous</a>`;
    elAnterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elAnterior);

    //Agregando los numeors de pagina

    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i=1; i<=totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page=item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=> {
            objDatos.currentPage=i;
            crearTabla();
        }
        pagination.append(el);
    }

    //Bonton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Next</a>`;
    elSiguiente.onclick=()=> {
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elSiguiente);
    
}

function agregarRestaurante() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
    initMap();
}

function limpiarForm(op) {
    formRestaurante.reset();
    document.querySelector("#idrestaurante").value="0";
}

function cancelarRestaurante() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarRestaurante(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("restaurantes/getOneRestaurante?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
            } else {
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                })
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}



function eliminarRestaurante(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed){
                API.get("restaurantes/deleteRestaurante?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarRestaurante();
                            Swal.fire({
                                icon:"info",
                                text:data.msg
                            });
                        } else {
                            Swal.fire({
                                icon:"error",
                                title:"Error",
                                text:data.msg
                            });
                        }
                    }
                ).catch(
                    error=>{
                        console.log("Error",error);
                    }
                );                
            }
        }
    ); 
    console.log("Mensaje de texto");
}

window.initMap = function () {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: { lat: 13.977068265503283, lng: -89.56345887982512 }
    });

    let marker;

    // Evento de clic en el mapa para colocar un marcador y obtener las coordenadas
    map.addListener('click', function(event) {
        placeMarker(event.latLng);
    });

    // Función para colocar un marcador en la posición dada y actualizar campos de latitud y longitud
    function placeMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        // Actualizar campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = location.lat();
        document.getElementById('longitud').value = location.lng();
    }
};

window.initMap2 = function () {
    map = new google.maps.Map(document.getElementById("map2"), {
        zoom: 18,
        center: { lat: 13.977068265503283, lng: -89.56345887982512 }
    });

    let marker;

    // Evento de clic en el mapa para colocar un marcador y obtener las coordenadas
    map.addListener('click', function(event) {
        placeMarker(event.latLng);
    });

    // Función para colocar un marcador en la posición dada y actualizar campos de latitud y longitud
    function placeMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        // Actualizar campos de latitud y longitud en el formulario
        document.getElementById('latitud').value = location.lat();
        document.getElementById('longitud').value = location.lng();
    }
};


/*window.initMap = function () {
    const coords = { lat: 13.977068265503283, lng: -89.56345887982512 };

    const map = new google.maps.Map(document.getElementById("map2"), {
        zoom: 6,
        center: coords,
    });
    const marker = new google.maps.Marker({
        position: coords,
        map,
    });
}*/





