//Variables globales y selectores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formIngredientes=document.querySelector("#formIngredientes");
const btnFiltrar=document.querySelector("#btnFiltrar");
const selectProducto = document.querySelector("#idproducto");
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
    btnNew.addEventListener("click",agregarIngrediente);
    btnCancelar.addEventListener("click",cancelarIngrediente);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    searchText.addEventListener("input",aplicarFiltro);
    formIngredientes.addEventListener("submit",guardarIngrediente);
    btnFiltrar.addEventListener("click",filtrarProductos);
    selectProducto.addEventListener("change", filtrarPorProducto);
}

//Funciones

function cargarDatos() {
    API.get("ingredientes/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarProductos();
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

function cargarProductos() {
    API.get("productos/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                const selectProducto = document.querySelector("#idproducto_select");
                selectProducto.innerHTML = "";
                data.records.forEach(
                    (item, index) => {
                        const { idproducto, nombre } = item;
                        const optionProducto = document.createElement("option");
                        optionProducto.value = idproducto;
                        optionProducto.textContent = nombre;
                        selectProducto.append(optionProducto);
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


function guardarIngrediente(event){
    event.preventDefault();
    const formData = new FormData(formIngredientes);
    //console.log(formData);
    API.post(formData,"ingredientes/save").then(
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
                const {nombre, descripcion, costo_adicional}=item;
                if (nombre.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (descripcion.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
                    return item;
                }
                if (costo_adicional.toUpperCase().search(objDatos.filter.toLocaleUpperCase())!=-1){
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
        }
    );
    //console.log(html);
    tableContent.innerHTML=html;
    crearPaginacion(); 
}

function mostrarDatosForm(record) {
    const {idingrediente, idproducto, descripcion, costo_adicional}=record;
    document.querySelector("#idingrediente").value=idingrediente;
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#costo_adicional").value=costo_adicional;
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

function agregarIngrediente() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(op) {
    formIngredientes.reset();
    document.querySelector("#idingrediente").value="0";
}

function cancelarIngrediente() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function editarIngrediente(id) {
    limpiarForm(1);
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("ingredientes/getOneIngrediente?id="+id).then(
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

function filtrarPorProducto() {
    objDatos.selectedProduct = selectProducto.value; 
}

function filtrarProductos() {
    const idProducto = selectProducto.value;
    if (idProducto === 'todos') {
        cargarDatos(); 
        cargarProductos();
        return;
    }
    
    API.get(`ingredientes/getByProducto?idproducto=${idProducto}`)
        .then(data => {
            if (data.success) {
                if (data.records.length > 0) {
                    objDatos.records = data.records;
                    objDatos.currentPage = 1;
                    crearTabla();
                } else {
                    limpiarTabla();
                    console.log("No hay ingredientes registrados para este producto.");
                }
            } else {
                limpiarTabla();
                console.log("Error al filtrar los ingredientes por producto");
            }
        })
        .catch(error => {
            console.error("Error en la llamada:", error);
        });
}


function limpiarTabla() {
    objDatos.records = [];
    objDatos.currentPage = 1;
    crearTabla();
}

