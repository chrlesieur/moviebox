let search = document.getElementById('movie_search_movieSearchByTitle');

window.addEventListener('load', function (e) {
    getDetailsMovie();

});


function getDetailsMovie() {
    let title = document.getElementById('movie_search_movieSearchByTitle').innerText;
    $('#movie_title').empty();
    $('#movie_img').empty();
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
console.log(details);
    let movieTitle = document.getElementById('movie_title');
        movieTitle.innerText = details['Title'];
    let myImg = document.getElementById('movie_img');
    myImg.src = details['Poster'];
    let year = document.getElementById('movie_year');
    year.innerText = details['Year'];
    console.log(details['Year']);
    let runTime = document.getElementById('movie_runtime');
    runTime.innerText = details['Runtime'];
    let genre = document.getElementById('movie_genre');
    genre.innerText = details['Genre'];
    let director = document.getElementById('movie_director');
    director.innerText = details['Director'];
    let actors = document.getElementById('movie_actors');
    actors.innerText = details['Actors'];
    let resume = document.getElementById('movie_resume');
    resume.innerText = details['Plot'];
    let country = document.getElementById('movie_country');
    country.innerText = details['Country'];
    let poster = document.getElementById('movie_poster');

    let rating = document.getElementById('movie_imdbRating');
    rating.innerText = details['Ratings'][0]['Value'];
}

