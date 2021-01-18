function loadDef() {
    var xhttp = new XMLHttpRequest();
    var phraseInput = document.getElementById('phrase-input')
    var phrase = phraseInput.value; 
    var definitions = document.getElementById('definitions');
    var phraseDisplay =  document.getElementById('phrase');
    phraseDisplay.innerHTML = "Searching for " + phrase + "...";
    phraseDisplay.style.color = "#009BFF";
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(this.responseText == "") {
                definitions.innerHTML = "Definition Unknown. Sorry about that!";
                phraseDisplay.innerHTML = "Could not find definition for " + phrase;
                phraseDisplay.style.color = "#FF0000";
            }
            else {
                definitions.innerHTML = this.responseText;
                phraseDisplay.innerHTML = "Detected definition for " + phrase;
                phraseDisplay.style.color="#3CB371";
            }
            phraseInput.value='';
            
        }
    };
    xhttp.open('GET', '../server/config.php?phrase='+phrase, true);
    xhttp.send();
}