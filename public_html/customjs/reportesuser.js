//variables y selectores
const btnViewReport=document.querySelector("#btnViewReport");
const idRestaurante=document.querySelector("#idrestaurante");
const idProducto=document.querySelector("#idproducto");
const frameReporte=document.querySelector("#framereporte");
const API=new Api()
//Eventos
eventListener();

function eventListener(){
    document.addEventListener("DOMContentLoaded", cargarDatos);
    btnViewReport.addEventListener("click", verReporte);
}

//Funciones

function cargarDatos() {
    API.get("productos/getAll").then(
        data=>{
            if (data.success) {
                idProducto.innerHTML="";
                const optionProducto=document.createElement("option");
                    optionProducto.value="0";
                    optionProducto.textContent="Todos";
                    idProducto.append(optionProducto);
                data.records.forEach(
                    (item,index)=>{
                        const {idproducto,nombre}=item;
                        const optionProducto=document.createElement("option");
                        optionProducto.value=idproducto;
                        optionProducto.textContent=nombre;
                        idProducto.append(optionProducto);
                    }
                );
            }
            cargarRestaurantes();
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}

function cargarRestaurantes() {
    API.get("restaurantes/getAll").then(
        data=>{
            if (data.success) {
                idRestaurante.innerHTML="";
                const optionRestaurante=document.createElement("option");
                optionRestaurante.value="0";
                optionRestaurante.textContent="Todos";
                idRestaurante.append(optionRestaurante);
                data.records.forEach(
                    (item, index)=>{
                        const {idrestaurante,nombre_restaurante}=item;
                        const optionRestaurante=document.createElement("option");
                        optionRestaurante.value=idrestaurante;
                        optionRestaurante.textContent=nombre_restaurante;
                        idRestaurante.append(optionRestaurante);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:", error);
        }
    );
}


/*function cargarPago() {
    API.get("ingresos/getAll").then(
        data=>{
            if(data.success) {
                idPago.innerHTML="";
                const optionPago=document.createElement("option");
                optionPago.value="0";
                optionPago.textContent="Todos";
                idPago.append(optionPago);
                data.records.forEach(
                    (item,index)=>{
                        const {metodopago}=item;
                        const optionPago=document.createElement("option");
                        optionPago.value=metodopago;
                        optionPago.textContent=metodopago;
                        idPago.append(optionPago);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error:",error);
        }
    );
}*/

function verReporte(){
    const fechaInicio = document.querySelector("#fecha_inicio").value;
    const fechaFin = document.querySelector("#fecha_fin").value;

    const url =`${BASE_API}reportesuser/getReporte?idproducto=${idProducto.value}&idrestaurante=${idRestaurante.value}`;

    // Agregar las fechas al URL si están presentes
    if (fechaInicio && fechaFin) {
        frameReporte.src = `${url}&fecha_inicio=${fechaInicio}&fecha_fin=${fechaFin}`;
    } else {
        frameReporte.src = url;
    }
}



