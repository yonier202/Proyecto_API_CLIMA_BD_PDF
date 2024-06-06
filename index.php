<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima - JavaScript Moderno</title>

    <link href="css/custom.css" rel="stylesheet">
    <link href="css/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mx-auto ">
        <h1 id="titulo" class="text-4xl mt-5 text-white font-bold uppercase text-center">Busca el Clima</h1>
        <div class="max-w-lg mx-auto ">

            <div class="p-6 mt-10">
                <div id="resultado">
                    <p class="text-center text-white mt-6">Agrega tu ciudad y país, el resultado se mostrará aquí</p>
                </div>
            </div>
            
            <form id="formulario" class="mt-10 " action="#" method="POST">
                <div class="mt-5">
                    <input 
                        type="text" 
                        name="ciudad"
                        id="ciudad"
                        placeholder="Escribe tu Ciudad"
                        class="w-full p-2 rounded"
                    />
                </div>
                <div class="mt-5">
                    <select 
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        id="pais"
                    >
                        <option disabled selected value="">-- Seleccione --</option>
                        <option value="AR">Argentina</option>
                        <option value="CO">Colombia</option>
                        <option value="CR">Costa Rica</option>
                        <option value="ES">España</option>
                        <option value="US">Estados Unidos</option>
                        <option value="MX">México</option>
                        <option value="PE">Perú</option>
                    </select>
                </div>

                <input 
                    type="submit"
                    class="mt-5 w-full bg-yellow-500 p-3 uppercase font-bold cursor-pointer rounded"
                    value="Obtener Clima"
                />

            </form>
                <a type="button"
                    href="/pdf/showPDF.php" target="_blank"
                    class="mt-5 w-full bg-red-600 p-3 uppercase font-bold cursor-pointer rounded text-center" 
                    >Obtener PDF
                </a>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>
</html>