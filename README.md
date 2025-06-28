# 🌐 Portal API en PHP

Este proyecto es un **Portal Web desarrollado con PHP y Bootstrap 5** que integra diferentes APIs públicas para ofrecer funcionalidades educativas, informativas y divertidas. Está orientado al aprendizaje del consumo de servicios REST en un entorno amigable y funcional.

## ⚙️ Tecnologías Utilizadas

| Herramienta    | Uso                              |
|----------------|----------------------------------|
| PHP            | Lenguaje backend principal       |
| HTML5 & CSS3   | Estructura y estilos básicos     |
| Bootstrap 5    | Framework CSS para diseño moderno|
| APIs REST      | Consumo de datos externos        |

## 📄 Funcionalidades

El portal contiene múltiples secciones, cada una basada en una API distinta:

### 🔹 Predicción de Género (`gender.php`)
Permite predecir el género de una persona a partir de su nombre, usando la API de [genderize.io](https://genderize.io/).

### 🔹 Predicción de Edad (`age.php`)
Estima la edad probable basada en un nombre. API: [agify.io](https://agify.io/).

### 🔹 Universidades por País (`universities.php`)
Lista universidades según el país ingresado (se puede escribir el país en español). API: [Hipolabs Universities API](http://universities.hipolabs.com/).

### 🔹 Clima Actual (`weather.php`)
Muestra el clima de una ciudad usando [OpenWeatherMap](https://openweathermap.org/). El ícono del clima se centra automáticamente.

### 🔹 Buscador de Pokémon (`pokemon.php`)
Consulta el nombre, imagen y habilidades de cualquier Pokémon usando [PokeAPI](https://pokeapi.co/).

### 🔹 Generador de Imágenes (`images.php`)
Busca imágenes relacionadas a una palabra clave (en español o inglés) mediante la API de [Pixabay](https://pixabay.com/api/).

### 🔹 Información de País (`country.php`)
Consulta datos detallados como capital, población, bandera y moneda de cualquier país, usando [REST Countries](https://restcountries.com/).

### 🔹 Chistes Aleatorios (`joke.php`)
Devuelve chistes al azar en español usando la API de [JokeAPI](https://v2.jokeapi.dev/).

### 🔹 Acerca de (`about.php`)
Página con los datos del creador y tecnologías empleadas en el proyecto.
