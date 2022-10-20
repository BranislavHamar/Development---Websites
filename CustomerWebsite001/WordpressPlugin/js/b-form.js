                    function ShowOption(x,y){
                      if(y==0){
                        document.getElementById('Option'+x).style.display='none';
                      }
                      else{
                        document.getElementById('Option'+x).style.display='block';
                      }
                      return;
                    }
                    
                      function admSelectCheck(z,y) { 
                        var x = document.getElementById('select'+z).value;
                        if(x == y) {
                          document.getElementById('Option'+y).style.display = 'block';
                        }else{
                          document.getElementById('Option'+y).style.display = 'none';
                        }
                        return;
                      }

                      function admSelectCheck2(z) { 
                          var e = document.getElementById('select'+z);
                          var text = e.options[e.selectedIndex].text;
                          
                          //alert(text);
                          
                          if(text == '0') {
                              document.getElementById('container-objekty-header').style.display = 'none';
                              document.getElementById('container-objekty').style.display = 'none';
                              document.getElementById('container-objekty-button').style.display = 'none';                              
                              document.getElementById('32[]').required = false;
                              document.getElementById('33[]').required = false;
                              document.getElementById('34[]').required = false;
                              document.getElementById('35[]').required = false;
                              document.getElementById('36[]').required = false;
                              document.getElementById('38[]').required = false;                                                                                                                         
                            }else {
                              document.getElementById('container-objekty-header').style.display = 'block';
                              document.getElementById('container-objekty').style.display = 'block';
                              document.getElementById('container-objekty-button').style.display = 'block';
                              document.getElementById('32[]').required = true;
                              document.getElementById('33[]').required = true;
                              document.getElementById('34[]').required = true;
                              document.getElementById('35[]').required = true;
                              document.getElementById('36[]').required = true;                                                                                          
                              document.getElementById('38[]').required = true;
                            }
                        return;
                      }

                    //Cloning
                     function cloning() {
                        var i = 0;
                        var original = document.getElementById('objekty');
                        
                          var clone = original.cloneNode(true); // 'deep' clone
                          clone.id = 'objekty' + ++i; // there can only be one element with an ID
                          original.parentNode.appendChild(clone);

                  }

                   function del(e) {
                        var idecko = document.getElementById(e);
                        idecko.remove();

                  }
 
  
                  function suhlas() {
                  
                        if (document.getElementById('suhlas').style.display == 'none') {
                            document.getElementById('suhlas').style.display = 'block';
                        } else {
                            document.getElementById('suhlas').style.display = 'none';                  
                        }      
                        return;
                  }
                                                      
                  //Modal
                      function myModal(item,status) {
                        var modal = document.getElementById('myModal'+item);                      

                        if(status == 1) { 
                        modal.style.display = 'block';
                        }else {
                        modal.style.display = 'none';
                        }
                              // When the user clicks anywhere outside of the modal, close it
                              window.onclick = function(event) {
                                if (event.target == modal) {
                                  modal.style.display = 'none';
                                }
                              }

                      }
                      
                   //Autocomplete
                    $( function() {
                      $( '#autocomplete_kraje' ).autocomplete({
                      minLength: 2,
                      source: function(request, response) {
                                    $.getJSON(
                              '../wp-content/plugins/b/includes/b-form.dataset.php',
                              { term:request.term, extraParams:'1' }, 
                              response
                          );
                      },
                      });

                      $( '#autocomplete_okresy' ).autocomplete({
                      minLength: 2,
                      source: function(request, response) {
                                    $.getJSON(
                              '../wp-content/plugins/b/includes/b-form.dataset.php',
                              { term:request.term, extraParams:'2' }, 
                              response
                          );
                      },
                      });

                      $( '#autocomplete_obce' ).autocomplete({
                      minLength: 2,
                      source: function(request, response) {
                                    $.getJSON(
                              '../wp-content/plugins/b/includes/b-form.dataset.php',
                              { term:request.term, extraParams:'3' }, 
                              response
                          );
                      },
                      });

                    });   
                    
                   function meno() {
                    document.getElementById('x01').innerHTML = document.getElementById('01').value;
                    document.getElementById('x02').innerHTML = document.getElementById('01').value;
                  }                    
                    
                    function ValidateSize(file) {
                        var FileSize = file.files[0].size / 1024 / 1024; // in MiB
                        if (FileSize > 2) {
                            alert('Súbor nesmie mať viac ako 2 MB!');
                            $(file).val(''); //for clearing with Jquery
                        } else {
                
                        }
                    }
