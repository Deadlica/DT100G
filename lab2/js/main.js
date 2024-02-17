"use strict";

document.addEventListener("DOMContentLoaded", function() {
    var url = "http://api.sr.se/api/v2/channels?format=json";
    var music = document.createElement("audio");

    display_navigation(url);


    //Event listener for the button
    document.getElementById("searchbutton").addEventListener("click", function(e) {
        let options = document.getElementById("searchProgram").options;
        let index = document.getElementById("searchProgram").selectedIndex;
        url = "http://api.sr.se/api/v2/scheduledepisodes?channelid=" + options[index].id + "&format=json";
        document.getElementById("info").innerHTML = "";
        display_tableu(url)
    })
    
    //Event listener for the navigation menu menu
    document.getElementById("mainnavlist").addEventListener("click", function(e) {
        url = "http://api.sr.se/api/v2/channels/" + e.target.id + "?format=json";
        music.src = "http://sverigesradio.se/topsy/direkt/srapi/" + e.target.id + "-hi.mp3";
        music.play();
        fetch(url)
        .then(response => response.json())
        .then(data => {
            let channelName;
            //Channel P2 has 2 id's, 1 which contradicts the id given in the json page giving all 10 channels
            if(data.channel.name != "P2 Musik") {
                channelName = data.channel.name;
            }
            else {
                channelName = "P2";
            }

            document.getElementById("searchProgram").value = channelName;

            //Sets values of the current channel, the music playing
            document.getElementById("info").innerHTML =
            "<h2>" + channelName + "</h2>" +
            "<h3>" + data.channel.tagline + "</h3>" +
            "<hr/>" +
            "<p id='previous'></p>" +
            "<p id='current'></p>" +
            "<p id='next'></p>";
            get_playlist(e.target.id);
        })
        .catch(error => {
            alert("Error: " + error);
        })
        
    })

    //Event listener clicking the header logo
    document.getElementById("logo").addEventListener("click", function() {
        music.pause();
        document.getElementById("info").innerHTML = "";
    })
});

function display_navigation(url) {
    fetch(url)
    .then(response => response.json())
    .then(data => {
        //data is parsed as an object
        for(var i = 0; i < data.pagination.size; i++) {
            //Variables for json data
            let id = data.channels[i].id;
            let image = data.channels[i].image;
            let name = data.channels[i].name;

            //Creates an <img>
            let img = document.createElement("img");
            img.id = id;
            img.src = image;
            img.style.width = "20px";
            img.style.height = "20px";

            //Creates an <li>
            let li = document.createElement("li");
            li.innerHTML = img.outerHTML + name;
            li.id = id;

            //Creates an <option>
            let option = document.createElement("option");
            option.innerHTML = name;
            option.value = name;
            option.id = id;

            //Adds the <li> and <option> to the document
            document.getElementById("mainnavlist").appendChild(li);
            document.getElementById("searchProgram").appendChild(option);
            }
        })
        .catch(error => {
            alert("Error: " + error);
        })
}

function get_playlist(id) {
    //Url for the playlist information
    let url = "http://api.sr.se/api/v2/playlists/rightnow?channelid=" + id + "&format=json";
    fetch(url)
    .then(response => response.json())
    .then(data => {
        //Previous song
        if(data.playlist.previoussong) {
            document.getElementById("previous").innerHTML = "Previous song: " +
            data.playlist.previoussong.description;
        }

        //Current song
        if(data.playlist.song) {
            document.getElementById("current").innerHTML = "Current Song: " +
            data.playlist.song.description;
            
        }
        //Next song
        if(data.playlist.nextsong) {
            document.getElementById("next").innerHTML = "Next song: " +
            data.playlist.nextsong.description;
        }
    })
    .catch(error => {
        alert("Error: " + error);
    })
}

function display_tableu(url) {
    fetch(url)
    .then(response => response.json())
    .then(data => {
        for(var i = 0; i < data.pagination.size; i++) {
            //Elements for the tableu
            let h2 = document.createElement("h2");
            let h3 = document.createElement("h3");
            let p = document.createElement("p");
            let hr = document.createElement("hr");

            //Sets values
            h2.innerHTML = data.schedule[i].title;
            h3.innerHTML = data.schedule[i].description;
            p.innerHTML = new Date(parseInt(data.schedule[i].starttimeutc.substr(6, 13)));

            //Adds them to html
            document.getElementById("info").appendChild(h2);
            document.getElementById("info").appendChild(h3);
            document.getElementById("info").appendChild(p);
            document.getElementById("info").appendChild(hr);
        }
    })
    .catch(error => {
        alert("Error: " + error);
    })
}