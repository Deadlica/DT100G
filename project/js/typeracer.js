"use strict"

const textElement = document.getElementById("text");//Displayed text
const textInputElement = document.getElementById("text_input");//Input field
const timer = document.getElementById("timer");//Timer

var interval;
var timerBool = true;
var totalWords;
var totalInputs;
var correctInputs;
var wpm;
var accuracy;
var subtractInputCounter = false;

const random_text_url = "https://api.quotable.io/random";

document.addEventListener("DOMContentLoaded", function() { //Scrolls to the top of the page on refresh
    window.scrollTo(0, 0);
})

document.addEventListener("keyup", function(event) {
    if(event.keyCode == 9) { //Reloads the page if [TAB] is pressed
        this.location.reload();
    }
    else if(event.keyCode == 8 && subtractInputCounter) { //Handles accuracy calculation when text is erased
        correctInputs--;
        subtractInputCounter = false;
    }
})

textInputElement.addEventListener("keypress", () => { //Starts timer on the first input in the textarea
    if(timerBool) {
        startTimer();
        timerBool = false;
    }
})

textInputElement.addEventListener("input", () => {
    const arrayText = textElement.querySelectorAll("span"); //Gets all text span
    const arrayValue = textInputElement.value.split(""); //Gets all the inputted text
    latestInputMatch(arrayText, arrayValue);
    let correct = true;
    totalInputs++;
    arrayText.forEach((characterSpan, index) => { //Compares each letter span with all the letters in the textarea
        const character = arrayValue[index];
        if(character == null) { //Text span color is white 
            characterSpan.classList.remove("correct");
            characterSpan.classList.remove("incorrect");
            correct = false;
        }
        else if(character === characterSpan.innerText) { //Text span color is green
            characterSpan.classList.add("correct");
            characterSpan.classList.remove("incorrect");
        }
        else { //Text span color is red
            characterSpan.classList.remove("correct");
            characterSpan.classList.add("incorrect");
            correct = false;
        }
    })
    if(correct) { //Player has won
        wpm = Math.round((arrayText.length / 5) / (getTimerTime() / 60)); //Calculates wpm
        accuracy = Math.round((correctInputs / totalInputs) * 100); //Calculates accuracy
        clearInterval(interval); //Resets timer
        timer.innerText = null;
        //Prints result screen
        document.getElementById("text_box").innerHTML = "<h3>WPM: " + wpm + "</h3><br /><h3>Accuracy: " + accuracy + "</h3><br /><h3>Time: " + getTimerTime() + "</h3><br /><p>Press [Tab] to restart test.</p>";
        fetch("/~sagr1908/DT100G/projekt/includes/submit_wpm.inc.php", { //Sends wpm score to database
            method: "POST",
            body: JSON.stringify(wpm),
            headers: {
                "Content-Type": "application/json"
            }
        });
    }
})

function getRandomText () { //Fetches random text from API
    return fetch(random_text_url)
    .then(response => response.json())
    .then(data => data.content)
}

async function getNextText() { //Sets up the game, initializes all the variables, displays the text.
    const text = await getRandomText();
    textElement.innerHTML = "";
    totalInputs = 0;
    correctInputs = 0;
    text.split("").forEach(character => {
        const characterSpan = document.createElement("span");
        characterSpan.innerText = character;
        textElement.appendChild(characterSpan);
    });
    textInputElement.value = null;
    totalWords = countWords(text);
}

let startTime;
function startTimer() { //Accurate timer function, that updates the displayed timer every 1000ms
    timer.innerText = 0;
    startTime = new Date();
    interval = setInterval(() => {
        timer.innerText = getTimerTime();
    }, 1000)
}

function getTimerTime() {
    return Math.floor((new Date() - startTime) / 1000);
}

function reset() { //Resets the game
    getNextText();
    clearInterval(interval);
    timer.innerText = null;
    timerBool = true;
}

function countWords(str) {
    return str.trim().split(/\s+/).length;
}

function latestInputMatch(arrayText, arrayValue) { //Checks if latest input was correct, to keep track of the accuracy
    const index = arrayValue.length - 1;
    if(arrayText[index].innerText == arrayValue[index]) {
        subtractInputCounter = true;
        correctInputs++;
    }
}

getNextText();