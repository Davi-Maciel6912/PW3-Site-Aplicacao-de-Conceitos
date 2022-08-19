const api = {
    key: "64ed82577ced7f69cb1687f0ce536131",
    base: "https://api.openweathermap.org/data/2.5/",
    //units:unidade de medida metric vai receber os     resultados em graus celsius
    lang: "pt_br",
    units: "metric"
}
// Selecionar os elementos do html no javascript
// A constante city retorna o elemento do html com a classe city
const city = document.querySelector('.city')

// A constante date retorna o elemento do html com a classe date
const date = document.querySelector('.date');

// A constante container_img retorna o elemento do html com a classe container_img
const container_img = document.querySelector('.container-img');

// A constante container_temp retorna o elemento do html com a classe container_temp
const container_temp = document.querySelector('.container-temp');

// A constante temp_number retorna o elemento do html com a classe container-temp div
const temp_number = document.querySelector('.container-temp div');

// A constante temp_unit retorna o elemento do html com a classe container-temp span
const temp_unit = document.querySelector('.container-temp span');

// A constante weather_tretorna o elemento do html com a classe weather
const weather_t = document.querySelector('.weather');

// A constante search_input retorna o elemento do html com a classe .form-control
const search_input = document.querySelector('.form-control');

// A constante search_button retorna o elemento do html com a classe btn
const search_button = document.querySelector('.btn');

// A constante low_high retorna o elemento do html com a classe low-high
const low_high = document.querySelector('.low-high');

//obter resultados pela geolocalização
//Nessa parte na primeira vez o navegador perguntará se pode utilizar a localização
window.addEventListener('load', () => {
    //if ("geolocation" in navigator)
    if (navigator.geolocation) {
        //Pegar a posição de latitude e longitudade para podermos utilizar na API,colocamos duas funções uma para se
        //der certo e a outra para se der um erro
        navigator.geolocation.getCurrentPosition(setPosition, showError);
    }
    else {
        alert('navegador não suporta geolocalização');
    }


    function setPosition(position) {
        console.log(position)
        //dentro do coords temos esses dois valores,que estamos atribuindo nestas duas variáveis e mandamos como parâmetro 
        //para a função coordResults
        let lat = position.coords.latitude;
        let long = position.coords.longitude;
        //a coordResults irá fazer a requisição para na API,pórem ao invés de ser pela cidade será com os valores de
        //latitude e longitude
        coordResults(lat, long);
    }
    function showError(error) {
        alert(`erro: ${error.message}`);
    }
})

//Essa função(coordResults irá fazer uma requisição na API,pelo método fetch,
//e nós iremos fazer essa requsição e retornará uma promprice e a idéia é que queremos a resposta em json)
function coordResults(lat, long) {
    //api.base é a base que estamos usando na linha 3 e nos temos que passar o nome da  cidade(na forma abaixo) 
    //e podemos passar parâmetros,como o lang o que dele é o pt-br e o units(unidade de medida por metro, e por final
    //passamos a chave da api)
    fetch(`${api.base}weather?lat=${lat}&lon=${long}&lang=${api.lang}&units=${api.units}&APPID=${api.key}`)
        .then(response => {
            console.timeLog(response)
        //caso a requisição der certo no inspecionar no ok aparecerá tru.Usar este comando
       //para ver console.timeLog(response)
       //Se o ok não for true(for false)vai ir para o erro e esse erro ele vai ir para o catch e o catch vai mostrar o erro
            if (!response.ok) {
                throw new Error(`http error: status ${response.status}`)
            }
               //terá uma função que retornará ela mesma(response => { ) em formato json
            return response.json();
        })
        .catch(error => {
            alert(error.message)
        })

          //teremos outra função que vai retornar ela mesma(response => { como parâmetro para outra função,a função displayResults
         //vai mostrar os valores na tela)
        .then(response => {
            displayResults(response)
        });
}

//Pegar o valor que digitamos no input
//Pegar depois que clicar no botão pesquisar,o addEventListenner vai esperar um evento(no caso o evento de clique
//e quando acontecer o clique, a função será acionada,essa função passará para a função searchResults o resultado
// do valor input como parâmetro)
search_button.addEventListener('click', function() {
    searchResults(search_input.value)
})

//Pegar quando apertar o botão de enter do teclado
//colocar um input para esperar um evento e quando tiver um keypress(uma tecla pressionada)ele vai acionar esta função
//a função enter vai passar esta tecla pressionada como parâmetro,a chave(key) e o event.keyCode keyCode é o código da tecla
// o 27 é o da tecla esc o 13 é da tecla enter,se for igual a 13 quer dizer que a pessoa pressionou enter e entrará na condição
//e essa condição acionará a função searchResults que vai passar como parâmetro o valor do input
search_input.addEventListener('keypress', enter)
function enter(event) {
    key = event.keyCode
    if (key === 13) {
        searchResults(search_input.value)
    }
}

//Essa função(searchResults irá fazer uma requisição na API,pelo método fetch,
//e nós iremos fazer essa requsição e retornará uma promprice e a idéia é que queremos a resposta em json)
function searchResults(city) {
//api.base é a base que estamos usando na linha 3 e nos temos que passar o nome da  cidade(na forma abaixo) 
    //e podemos passar parâmetros,como o lang o que dele é o pt-br e o units(unidade de medida por metro, e por final
    //passamos a chave da api)
    fetch(`${api.base}weather?q=${city}&lang=${api.lang}&units=${api.units}&APPID=${api.key}`)
        .then(response => {
            console.timeLog(response)
//caso a requisição der certo no inspecionar no ok aparecerá tru.Usar este comando
       //para ver console.timeLog(response)
       //Se o ok não for true(for false)vai ir para o erro e esse erro ele vai ir para o catch e o catch vai mostrar o erro
            if (!response.ok) {
                throw new Error(`http error: status ${response.status}`)
            }
   //terá uma função que retornará ela mesma(response => { ) em formato json
            return response.json();
        })
        .catch(error => {
            alert(error.message)
        })
  //teremos outra função que vai retornar ela mesma(response => { como parâmetro para outra função,a função displayResults
    //vai mostrar os valores na tela)
        .then(response => {
            displayResults(response)
        });
}


function displayResults(weather) {
    console.log(weather)

    //Passar o elemento do javascript que selecionamos na linha 10 e passar o atributo innerText(passar um texto para
    //a div da city)
    //${weather.name} quer dizer o resultado em json .name, que irá mostrar o nome da cidade que foi escrito
    // .sys.coutry irá passar a sigla do país
    city.innerText = `${weather.name}, ${weather.sys.country}`;

    //iremos utilizar uma função do javascript,que gera a data atual,temos que colocar new Date();E o date.innerText
    //para passar um texto para a div da date)
    let now = new Date();
    //O resultado que aparecerá aqui terá vindo de uma função,essa função vai receber como parâmetro o resultado
    //que foi gerado pela data Atual
    date.innerText = dateBuilder(now);

    let iconName = weather.weather[0].icon;
    //o innerHTML reconhece que o img não é um texto puro,não é qualquer texto,é uma tag do html
    container_img.innerHTML = `<img src="./icones/${iconName}.png">`;

    //Math.round arredonda um valor
    let temperature = `${Math.round(weather.main.temp)}`
    //temp_number colocar o resultado da linha 168 na linha 171 com o } °c na tag span  da página(previsao-tempo.php)
    temp_number.innerHTML = temperature;
    temp_unit.innerHTML = `°c`;

    weather_tempo = weather.weather[0].description;
    weather_t.innerText = capitalizeFirstLetter(weather_tempo)

    low_high.innerText = `${Math.round(weather.main.temp_min)}°c / ${Math.round(weather.main.temp_max)}°c`;
}

function dateBuilder(d) {
    //Criamos um array,uma lista dos dias da semana e também dos meses,
    let days = ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"];
    let months = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];


    //Para mexermos com meses,data,anos são necessárias estas funções do javascript
    let day = days[d.getDay()]; //getDay: Retornará um número de 0-6(0=domingo,1=segunda...)
    let date = d.getDate();
    let month = months[d.getMonth()];
    let year = d.getFullYear();

    return `${day}, ${date} ${month} ${year}`; //retornar dia,mes e ano
}

//Ao clicar no quadrado com a temperatura é feita a conversão de celsius para fahrenheits
//Selecionar o container e colocar ele para esperar uma ação(um evento,um clique)

container_temp.addEventListener('click', changeTemp)
function changeTemp() {
    //o que estiver no temp_nuber_now,pegamos o valor atual do temp_number
    temp_number_now = temp_number.innerHTML

    //se a unidade de medida for °C cairá neste if,iremos obter o resultado em fahrenheit,para isso usamos a fórmula(de conversão)
    //e depois iremos escrever f ao invés de c(linha 206)
    if (temp_unit.innerHTML === "°c") {
        let f = (temp_number_now * 1.8) + 32
        temp_unit.innerHTML = "°f"
        //Aqui será o valor do calculo
        temp_number.innerHTML = Math.round(f)
    }
    else {
        let c = (temp_number_now - 32) / 1.8
        temp_unit.innerHTML = "°c"
        temp_number.innerHTML = Math.round(c)
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}