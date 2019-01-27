let search = document.getElementById('movie_search_movieSearchByTitle');

window.addEventListener('load', function (e) {
    getDetailsMovie();

});


function getDetailsMovie() {
    let title = document.getElementById('movie_search_movieSearchByTitle').innerText;
    $('#movie_title').empty();
    $('#movie_year').empty();
    $('#movie_runtime').empty();
    $('#movie_genre').empty();
    $('#movie_director').empty();
    $('#movie_actors').empty();
    $('#movie_resume').empty();
    $('#movie_country').empty();
    $('#movie_poster').empty();
    $('#movie_imdbRating').empty();

    if (title !== " ") {
        fetch("/movie/details/"+ title)
            .then((resp) => resp.json())
            .then((data) => setDetails(data))
    }
}
function setDetails(details) {

    let title = document.getElementById('movie_title');
        title.value = details['Title'];
    let year = document.getElementById('movie_year');
    year.value = details['Year'];
    let runTime = document.getElementById('movie_runtime');
    runTime.value = details['Runtime'];
    let genre = document.getElementById('movie_genre');
    genre.value = details['Genre'];
    let director = document.getElementById('movie_director');
    director.value = details['Director'];
    let actors = document.getElementById('movie_actors');
    actors.value = details['Actors'];
    let resume = document.getElementById('movie_resume');
    resume.value = details['Plot'];
    let country = document.getElementById('movie_country');
    country.value = details['Country'];
    let poster = document.getElementById('movie_poster');
    poster.value = details['Poster'];
    let rating = document.getElementById('movie_imdbRating');
    rating.value = details['Ratings'][0]['Value'];
}

