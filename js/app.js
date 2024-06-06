const container = document.querySelector('.container');
const resultado = document.querySelector('#resultado');
const formulario = document.querySelector('#formulario');

window.addEventListener('load', ()=>{
    formulario.addEventListener('submit', buscarClima);
});

function buscarClima(e) {
    e.preventDefault();

    const ciudad = document.querySelector('#ciudad').value;
    const pais = document.querySelector('#pais').value;

    if (ciudad === "" || pais === "") {
        mostrarError('Ambos campos son obligatorios');

        return;
    }

    consultarAPI(ciudad, pais);
}

function mostrarError(mj) {
    console.log(mj);
    const alerta = document.querySelector('.bg-red-100');
    if (!alerta) {
        const alerta = document.createElement('div');
        alerta.classList.add('bg-red-100', 'border-red', 'text-red-700', 'px-4', 'py-3', 'rounded',
            'max-w-md', 'mx-auto', 'mt-6', 'text-center');
        alerta.innerHTML = `
            <strong class="font-bold">Error!</strong>
            <span class="block">${mj}</span>
        `;
        container.appendChild(alerta);
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    
}

function consultarAPI(ciudad, pais) {
    const appId = "c38c4230c45aeb052f0ca8a4fb13ba78";

    const url = `https://api.openweathermap.org/data/2.5/weather?q=${ciudad},${pais}&appid=${appId}`;
    console.log(url);

    Spinner();
    fetch(url)
        .then(respuesta => respuesta.json())
        .then(datos => {
            // Limpiar Html Previo
            limpiarHtml();
            if (datos.cod === "404") {
                mostrarError('Ciudad no encontrada');
                
                return
            }
            mostrarClima(datos);
        })
}

function guardarDatosBD(datos) {
    fetch('http://localhost/proyecto-api-reporte/php/guardarDatosBD.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        })
    .then(response => response.text())
    .then(result => {
        console.log('Datos guardados:', result);
    })
    .catch(error => {
        console.error('Error al guardar los datos:', error);
    });   
}

function mostrarClima(datos) {
    const { id, name, main: {temp, temp_min, temp_max}} = datos;
    
    const data = {
        id: id,
        nombre: name,
        temp: temp,
        temp_min: temp_min,
        temp_max: temp_max
    };

    // console.log(data);

    guardarDatosBD(data);
    // console.log(temp);

    const centigrados = KelvinACentigrados(temp);
    const min = KelvinACentigrados(temp_min); 
    const max = KelvinACentigrados(temp_max); 

    const nombreCiudad = document.createElement('p');
    nombreCiudad.textContent = `Clima en ${name}`;
    nombreCiudad.classList.add('font-bold', 'text-2xl')

    const actual = document.createElement('p');
    actual.innerHTML = `
        ${centigrados} &#8451;
    `;
    actual.classList.add('font-bold', 'text-6xl' );

    const tempMaxima = document.createElement('p');
    tempMaxima.innerHTML =`
        Max: ${max} &#8451;
    `;
    tempMaxima.classList.add('text-xl' );

    const tempMin = document.createElement('p');
    tempMin.innerHTML =`
        Min: ${min} &#8451;
    `;
    tempMin.classList.add('text-xl' );

    const resultadoDiv = document.createElement('div');
    resultadoDiv.classList.add('text-center', 'text-white');
    resultadoDiv.appendChild(nombreCiudad);
    resultadoDiv.appendChild(actual);
    resultadoDiv.appendChild(tempMaxima);
    resultadoDiv.appendChild(tempMin);

    resultado.appendChild(resultadoDiv);

}

function limpiarHtml() {
    while (resultado.firstChild) {
        resultado.removeChild(resultado.firstChild);
    }
}

function KelvinACentigrados(grados) {
    return parseInt(grados - 273.15);
}

function Spinner() {
    limpiarHtml();
    const divSpinner = document.createElement('div');
    divSpinner.classList.add('sk-fading-circle');
    divSpinner.innerHTML= 
    `
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
        
    `
    resultado.appendChild(divSpinner);
}