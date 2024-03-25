//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formProductos=document.querySelector("#formProductos");
const divFoto1=document.querySelector("#divfoto1");
const inputFoto1=document.querySelector("#foto1");
const divFoto2=document.querySelector("#divfoto2");
const inputFoto2=document.querySelector("#foto2");
const divFoto3=document.querySelector("#divfoto3");
const inputFoto3=document.querySelector("#foto3");
//INGREDIENTES
const panelDatosIngre=document.querySelector("#contentTableC");
const btnNewIngre=document.querySelector("#btnAgregarIngre");
const tableContentC = document.querySelector("#contentTableC table tbody");
const paginationC=document.querySelector(".paginationC");
const formIngredientes = document.querySelector("#formIngredientes");
const panelFormIngre=document.querySelector("#contentFormIngre");
const btnCancelarIngre=document.querySelector("#btnCancelarIngre");
const btnAdd=document.querySelector("#agregarIngre");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:10,
    filter:""
}

//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnNew.addEventListener("click",agregarProducto);
    btnCancelar.addEventListener("click",cancelarProducto);
    btnCancelarIngre.addEventListener("click",cancelarIngrediente);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    document.addEventListener("DOMContentLoaded",cargarDatosC);
    searchText.addEventListener("input",aplicarFiltro);
    formProductos.addEventListener("submit",guardarProducto);
    formIngredientes.addEventListener("submit",guardarIngrediente)
    divFoto1.addEventListener("click",agregarFoto1);
    inputFoto1.addEventListener("change",actualizarFoto1);
    divFoto2.addEventListener("click",agregarFoto2);
    inputFoto2.addEventListener("change",actualizarFoto2);
    divFoto3.addEventListener("click",agregarFoto3);
    inputFoto3.addEventListener("change",actualizarFoto3);
}

//Funciones

function cargarDatos() {
    API.get("productos/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarRestaurantes();
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

function cargarRestaurantes() {
    API.get("restaurantes/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                const txtRestaurante=document.querySelector("#idrestaurante");
                txtRestaurante.innerHTML="";
                data.records.forEach(
                    (item, index)=>{
                        const {idrestaurante, nombre_restaurante}=item;
                        const optionRestaurante=document.createElement("option");
                        optionRestaurante.value=idrestaurante;
                        optionRestaurante.textContent=nombre_restaurante;
                        txtRestaurante.append(optionRestaurante);
                    }
                );
            } 
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    );
}

function guardarProducto(event){
    event.preventDefault();
    const formData = new FormData(formProductos);
    //console.log(formData);
    API.post(formData,"productos/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarProducto();
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

function actualizarFoto1(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto1.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFoto1() {
    inputFoto1.click();
}

function actualizarFoto2(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto2.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFoto2() {
    inputFoto2.click();
}

function actualizarFoto3(el) {
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            divFoto3.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFoto3() {
    inputFoto3.click();
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
                const {nombre_restaurante, nombre, descripcion, precio}=item;
                if (nombre_restaurante.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (descripcion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (precio.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
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
                    <td>${item.nombre}</td>
                    <td>${item.descripcion}</td>
                    <td>${item.precio}</td>
                    <td>
                        <button type="button" class="btn btn-dark btncolor" onclick="editarProducto(${item.idproducto})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-danger btncolor" onclick="eliminarProducto(${item.idproducto})"><i class="fa-solid fa-trash"></i></button>
                        <button type="button" class="btn btn-secondary btncolor" id="agregarIngre" onclick="agregarIngre(${item.idproducto})"><i class="fa-solid fa-plus"></i></button>
                        <button class="btn btn-info" type="button" id="listaIngredientes" onclick="listarC(${item.idproducto})"><i class="fa-solid fa-file-pen"></i></button>
                    </td>
                    </tr>
                
                `;
            }
        }
    );
    //console.log(html);
    tableContent.innerHTML=html;
    crearPaginacion(); 
}

function mostrarDatosForm(record) {
    const {idproducto, idrestaurante, nombre, descripcion, foto1, foto2, foto3, precio}=record;
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#idrestaurante").value=idrestaurante;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#descripcion").value=descripcion;
    divFoto1.innerHTML=`<img src="${foto1}" class="h-100 w-100" style="object-fit:contain;">`;
    divFoto2.innerHTML=`<img src="${foto2}" class="h-100 w-100" style="object-fit:contain;">`;
    divFoto3.innerHTML=`<img src="${foto3}" class="h-100 w-100" style="object-fit:contain;">`;
    document.querySelector("#precio").value=precio;
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

    //Boton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Next</a>`;
    elSiguiente.onclick=()=> {
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    }
    pagination.append(elSiguiente);
    
}

function agregarProducto() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formProductos.reset();
    document.querySelector("#idproducto").value="0";
    divFoto1.innerHTML="";
    divFoto2.innerHTML="";
    divFoto3.innerHTML="";
}

function cancelarProducto() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarProducto(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("productos/getOneProducto?id="+id).then(
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



function eliminarProducto(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed){
                API.get("productos/deleteProducto?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarProducto();
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


// Contenido Ingredientes
//Listar los Ingredientes
function listarC(id) {
    console.log(id);
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'),{
        keyboard: false
    })
    myModal.show();
    cargarDatosC(id);
}
// Carga de datos en el modal
function cargarDatosC(id) {
    //console.log("Cargando datos");
    API.get("ingredientes/getAllId?id="+id)
    .then((data) => {
        //console.log(data.records);
        if (data.success) {
        objDatos.records = data.records;
        objDatos.currentPage = 1;
        crearTablaC();
        cargarProductosC();
        } else {
        console.log("Error al recuperar los registros");
        }
    })
    .catch((error) => {
        console.error("Error en la llamada:", error);
    });
}

// Funciones

function guardarIngrediente(event){
    event.preventDefault();
    const formDataIngre = new FormData(formIngredientes);
    //console.log(formData);
    API.post(formDataIngre,"ingredientes/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarIngrediente();
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

function editarIngrediente(id) {
    limpiarForm(1);
    panelDatosIngre.classList.add("d-none");
    panelFormIngre.classList.remove("d-none");
    API.get("ingredientes/getOneIngrediente?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosFormIngre(data.records[0]);
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

function agregarIngrediente() {
    panelDatosIngre.classList.add("d-none");
    panelFormIngre.classList.remove("d-none");
    limpiarFormIngre();
}

function eliminarIngrediente(id) {
    Swal.fire({
        title:"¿Ésta seguro de eliminar el registro?",
        showDenyButton:true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        resultado=>{
            console.log(resultado.isConfirmed);
            if (resultado.isConfirmed){
                API.get("ingredientes/deleteIngrediente?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarIngrediente();
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

function limpiarFormIngre(op) {
    formIngredientes.reset();
    document.querySelector("#idingrediente").value="0";
    
}

function cancelarIngrediente() {
    panelDatosIngre.classList.remove("d-none");
    panelFormIngre.classList.add("d-none");
    const closeButton = document.querySelector("[data-dismiss='modal']");
    if (closeButton) {
        closeButton.click();
    }
}

// Modal Listado tabla
function crearTablaC() {
    if (objDatos.filter == "") {
    objDatos.recordsFilter = objDatos.records.map((item) => item);
    } else {
    objDatos.recordsFilter = objDatos.records.filter((item) => {
    const {
        idingrediente,nombre,descripcion,costo_adicional} = item;
        if (
        idingrediente.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
        ) {
        return item;
        }
        if (
        nombre
            .toUpperCase()
            .search(objDatos.filter.toUpperCase()) != -1
        ) {
        return item;
        }
        if (
        descripcion.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
        ) {
        return item;
        }
        if (
        costo_adicional.toUpperCase().search(objDatos.filter.toUpperCase()) != -1
        ) {
        return item;
        }
    });
    }
    const recordIni =
      objDatos.currentPage * objDatos.recordsShow - objDatos.recordsShow;
    const recordFin = recordIni + objDatos.recordsShow - 1;
    let html = "";
    objDatos.recordsFilter.forEach((item, index) => {
    if (index >= recordIni && index <= recordFin) {
        html += `
            <tr>
            <td>${item.idingrediente}</td>
            <td>${item.nombre}</td>
            <td>${item.descripcion}</td>
            <td>${item.costo_adicional}</td>
            <td>
            <button type="button" class="btn btn-dark btncolor" onclick="editarIngrediente(${item.idingrediente})"><i class="fa-solid fa-pen-to-square"></i></button>
            <button type="button" class="btn btn-danger btncolor" onclick="eliminarIngrediente(${item.idingrediente})"><i class="fa-solid fa-trash"></i></button>
            </td>
            </tr>
        `;
    }
    });
    tableContentC.innerHTML = html;
    crearPaginacionC();
}

function mostrarDatosFormIngre(record) {
    const {idingrediente, idproducto, nombre, descripcion, costo_adicional}=record;
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#idingrediente").value=idingrediente;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#costo_adicional").value=costo_adicional;
}

/*function crearPaginacionC() {
    //Borrar elementos
    paginationC.innerHTML="";
    //Boton Anterior
    const elAnteriorC=document.createElement("li");
    elAnteriorC.classList.add("page-itemC");
    elAnteriorC.innerHTML=`<a class="page-linkC" href="#">Anterior</a>`;
    elAnteriorC.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTablaC();
    }
    paginationC.append(elAnteriorC);
    //Agregando los numeros de pagina
    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i=1; i<=totalPage;i++) {
        const elC=document.createElement("li");
        elC.classList.add("page-itemC");
        elC.innerHTML=`<a class="page-linkC" href="#">${i}</a>`;
        elC.onclick=()=> {
            objDatos.currentPage=i;
            crearTablaC();
        }
        paginationC.append(elC);
    }
    //Boton siguiente
    const elSiguienteC=document.createElement("li");
    elSiguienteC.classList.add("page-itemC");
    elSiguienteC.innerHTML=`<a class="page-linkC" href="#">Siguiente</a>`;
    elSiguienteC.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTablaC();
    }
    paginationC.append(elSiguienteC);
}*/

function cargarProductosC() {
    API.get("ingredientes/getNameById")
    .then((data) => {
        if (data.success) {
        const txtProducto = document.querySelector("#idproducto");
        txtProducto.innerHTML = "";
        data.records.forEach((item, index) => {
            const { idproducto, nombre } = item;
            const optionProducto = document.createElement("option");
            optionProducto.value = idproducto;
            optionProducto.textContent = nombre;
            txtProducto.append(optionProducto);
        });
        }
    })
    .catch((error) => {
        console.error("Error:", error);
    });
}

// Función Agregar Ingrediente

function agregarIngre(id) {
    location.href="/mycontrolgps/ingreforms?id="+id;
}
