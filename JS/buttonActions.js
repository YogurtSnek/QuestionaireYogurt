const questions = document.getElementsByClassName("question");
let currentQ = 0;

for (let i = 1; i < questions.length; i++) {
    questions[i].setAttribute("style", "animation-name: slideRight;"
    +"animation-duration: 2s;"
    +"animation-direction: normal;"
    +"animation-timing-function: cubic-bezier(.32,.88,.49,1.39);"
    +"animation-iteration-count: 1;"
    +"animation-fill-mode: forwards;"
    +"left: 200%");

}


function OnClickPrev() {
    if (currentQ != 0) {
        
        console.log("Current Questions: " + currentQ)

        questions[currentQ].setAttribute("style", "animation-name: slideCenterRight;"
        +"animation-duration: 2s;"
        +"animation-direction: normal;"
        +"animation-timing-function: cubic-bezier(.51,1.56,.63,1.09);"
        +"animation-iteration-count: 1;"
        +"animation-fill-mode: forwards;");

        currentQ -= 1
        
        questions[currentQ].setAttribute("style", "animation-name: slideLeftCenter;"
        +"animation-duration: 2s;"
        +"animation-direction: normal;"
        +"animation-timing-function: cubic-bezier(.51,1.56,.63,1.09);"
        +"animation-iteration-count: 1;"
        +"animation-fill-mode: forwards;");
        
        

    }
}

function OnClickNext() {
    if (currentQ != questions.length - 1) {

        console.log("Current Questions: " + currentQ)

        questions[currentQ].setAttribute("style", "animation-name: slideCenterLeft;"
        +"animation-duration: 2s;"
        +"animation-direction: normal;"
        +"animation-timing-function: cubic-bezier(.51,1.56,.63,1.09);"
        +"animation-iteration-count: 1;"
        +"animation-fill-mode: forwards;");

        currentQ += 1
        
        questions[currentQ].setAttribute("style", "animation-name: slideRightCenter;"
        +"animation-duration: 2s;"
        +"animation-direction: normal;"
        +"animation-timing-function: cubic-bezier(.51,1.56,.63,1.09);"
        +"animation-iteration-count: 1;"
        +"animation-fill-mode: forwards;");

    } else {
        console.log("End of Questions.")
    }
}



