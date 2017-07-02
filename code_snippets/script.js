function ToggleDisplay(id1, id2, button1, button2) {
    var x = document.getElementById(id1);
    var y = document.getElementById(id2);
    var a = document.getElementById(button1);
    var b = document.getElementById(button2);
    
    if (x.style.display === 'block') {
    	return;
    }
    else{
        x.style.display = 'block';
        y.style.display = 'none';
        a.classList.toggle("active");
    	b.classList.toggle("active");
    }
}

