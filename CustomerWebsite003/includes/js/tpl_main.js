// Javascript for Trustsolutions


function mail(hostname,username) {

    window.location = 'mail' + 'to:' + username + '@' + hostname + '.com';
}


var element_id = "";
var state = 0;

function open_close(id)
{
	if ( state == 0 )
	{
		state = 1;
		element_id = id;
		document.getElementById( id ).style.display = 'block';
		document.getElementById( '30' ).style.display = 'none';
		document.getElementById( id + '_menu' ).style.fontWeight  = 'bold';
		document.getElementById( id + '_menu' ).style.color  = 'CA7058';
	}
	else
	{
		if ( id == element_id )
		{
			state = 0;
			document.getElementById( id ).style.display = 'none';
			document.getElementById( '30' ).style.display = 'block';
			document.getElementById( id + '_menu').style.fontWeight  = 'bold';
			document.getElementById( element_id + '_menu').style.color = '';
		}
		else
		{
		
			state = 1;
			document.getElementById( element_id ).style.display = 'none';
			document.getElementById( element_id + '_menu').style.fontWeight = '';
			document.getElementById( element_id + '_menu').style.color = '';
			
			document.getElementById( id ).style.display = 'block';
			document.getElementById( '30' ).style.display = 'none';
			document.getElementById( id + '_menu').style.fontWeight = 'bold';
		document.getElementById( id + '_menu' ).style.color  = 'CA7058';
			
			element_id = id;
		}
	}
}

var element_id2 = "";
var state2 = 0;

function open_close2(id2)
{

	if ( state2 == 0 )
	{
		state2 = 1;
		element_id2 = id2;
		document.getElementById( id2 ).style.display = 'block';
		document.getElementById( id2 + '_menu2' ).style.fontWeight  = 'bold';
	}
	else
	{
		if ( id2 == element_id2 )
		{
			state2 = 0;
			document.getElementById( id2 ).style.display = 'none';
			document.getElementById( id2 + '_menu2').style.fontWeight  = 'bold';
		}
		else
		{
		
			state2 = 1;
			document.getElementById( element_id2 ).style.display = 'none';
			document.getElementById( element_id2 + '_menu2').style.fontWeight = '';

			document.getElementById( id2 ).style.display = 'block';
			document.getElementById( id2 + '_menu2').style.fontWeight = 'bold';
			
			element_id2 = id2;
		}
	}
}

var l = "";

function alertTheUser ( l ){

  if (l == 1) {
  alert("ĎAKUJEME! Vaša emailová adresa bola pridaná do našej databázy");
  }
  if (l == 0) {
  alert("POZOR! Nevyplnili ste správne požadované polia");
  }
}





function submitonce(theform){
//if IE 4+ or NS 6+
if (document.all||document.getElementById){
//screen thru every element in the form, and hunt down "submit" and "reset"
for (i=0;i<theform.length;i++){
var tempobj=theform.elements[i]
if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
//disable em
tempobj.disabled=true
}
}
}
