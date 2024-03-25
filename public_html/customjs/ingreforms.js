//Variables globales y selectores
const idpro=document.querySelector("#idproducto");
const btnCancelar=document.querySelector("#btnCancelar");
const formIngredientes=document.querySelector("#formIngredientes");
const API=new Api();
//Configuracion de eventos
eventListiners();
function eventListiners() {
    btnCancelar.addEventListener("click", cancelarAgregarIngre);
    //console.log("Antes de cargar");
    document.addEventListener("DOMContentLoaded",cargarDatos);
    //console.log("Despues de cargar");
    formIngredientes.addEventListener("submit",guardarIngrediente);

}

//Funciones

function cargarDatos() {
    idpro.value = idproducto;
    API.get("ingreforms/getAll").then(
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

function cancelarAgregarIngre() {
    location.href = "/mycontrolgps/productos";
}

function cargarProductos() {
    API.get("productos/getAll").then(
        data=>{
            //console.log(data.records);
            if (data.success) {
                const txtProducto=document.querySelector("#idproducto");
                txtProducto.innerHTML="";
                data.records.forEach(
                    (item, index)=>{
                        const {idproducto, nombre}=item;
                        const optionProducto=document.createElement("option");
                        optionProducto.value=idproducto;
                        optionProducto.textContent=nombre;
                        txtProducto.append(optionProducto);
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
    API.post(formData,"ingreforms/save").then(
        data=>{
            //console.log(data.msg);
            if (data.success){
                cancelarAgregarIngre();
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
    const formData = new FormData(formIngredientes);
    API.get("ingreforms/getOneIngreForms?id="+id).then(
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

function mostrarDatosForm(record) {
    const {idingrediente, idproducto, descripcion, costo_adicional}=record;
    document.querySelector("#idingrediente").value=idingrediente;
    document.querySelector("#idproducto").value=idproducto;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#costo_adicional").value=costo_adicional;
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
