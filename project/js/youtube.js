"use strict"

var baseURL = "https://www.googleapis.com/youtube/v3/search?key="
var link = "";
var searchResults = "";
var videoList = new Map();

document.addEventListener("DOMContentLoaded", function() {
    var API_KEY = "";
    //Fetches API key from php file to keep it hidden
    fetch("/~sagr1908/DT100G/projekt/includes/getYoutubeToken.inc.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify("ok")
    })
    .then(response => response.text())
    .then(data => {
        API_KEY = data.substr(12, 39);
    });

    document.getElementById("search").addEventListener("keydown", function(event) { //[ENTER] key pressed to search
        if(event.keyCode == 13) {
            document.getElementById("searchButton").click(); //Clicks the search button
        }
    })

    document.getElementById("searchButton").addEventListener("click", function() {
        var search = document.getElementById("search").value; //Gets the search string

        document.getElementById("video_links").innerHTML = ""; //Resets the video links
        videoList.clear(); //Clears the map
        
        videoSearch(API_KEY, search, 12);
    })
})

function displayVideo(index) { //Creates element for a specific video saved in the map "videoList"
    let video = videoList.get(index);
    //Creates video
    document.getElementById("videos").innerHTML = "<iframe src='https://www.youtube.com/embed/" + video.id.videoId + "' id='video' class='video' allowfullscreen></iframe>";
    //Creates title
    document.getElementById("videos").innerHTML += "<h1 id='title'>" + video.snippet.title + "</h1>";
    //Creates date
    document.getElementById("videos").innerHTML += "<p id='date'>" + video.snippet.publishedAt + "</p><br />";
    //Creates description
    document.getElementById("videos").innerHTML += "<h3 id='description'>" + video.snippet.description + "</h3>";
    window.scrollTo(0, 0);
}

function videoSearch(key, search, maxResults) {
    fetch(baseURL + key + "&type=video&part=snippet&maxResults=" + maxResults + "&q=" + search) //Fetches result from searchstring, gets 12 results
    .then(response => response.json())
    .then(data => {
        if(data.error) {
            if(data.error.code == 403) { //Checks if the API KEY's max quota per day has already been used
                alert("Error: Max quota for the day used");
                return;
            }
        }
        searchResults = data;
        let i = 0;
        document.getElementById("video_links").innerHTML = "<hr />"
        data.items.forEach(item => {
            videoList.set(i, item); //Adds the video data to the map
            //Creates a div, with an image, a link that both has a function to create and play the video
            document.getElementById("video_links").innerHTML +=
            "<div class='videoSearch'><img src='" + item.snippet.thumbnails.medium.url + "' onclick='displayVideo(" + i + ")'><a href='#' onclick='displayVideo(" + i++ + ")'>" + item.snippet.title + "</a></div><hr />";
        });
    })
}