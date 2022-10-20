                    //Cloning
                     function cloning() {
                        var i = 0;
                        var original = document.getElementById('objekty');
                        
                          var clone = original.cloneNode(true); // 'deep' clone
                          clone.id = 'objekty' + ++i; // there can only be one element with an ID
                          original.parentNode.appendChild(clone);

                  }


                               
                                                  
                   //Autocomplete
                    $( function() {
                      //autocomplete_kraje
                      $( '#04' ).autocomplete({
                      minLength: 2,
                      source: function(request, response) {
                                    $.getJSON(
                              '../wp-content/plugins/b/includes/b-form.dataset.php',
                              { term:request.term, extraParams:'1' }, 
                              response
                          );
                      },
                      });

                      //autocomplete_okresy
                      $( '#05' ).autocomplete({
                      minLength: 2,
                      source: function(request, response) {
                                    $.getJSON(
                              '../wp-content/plugins/b/includes/b-form.dataset.php',
                              { term:request.term, extraParams:'2' }, 
                              response
                          );
                      },
                      });

                      //autocomplete_obce
                      $( '#06' ).autocomplete({
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

                     $(document).ready(function(){
                         $('#gpsbutton').click(function(event){     
                              $.getJSON('https://nominatim.openstreetmap.org/search?q='+$('#06').val()+'+'+$('#07').val()+'&format=json&polygon=1&addressdetails=1', function(result){
                                $('#A008').val(result[0].lon)
                                $('#A009').val(result[0].lat)                                
                                });
                            });
                    });
                            
                    
                        $( function() {
                          $.datepicker.regional['sk'] = {
                              closeText: 'Zavrieť', // set a close button text
                              currentText: 'Dnes', // set today text
                              monthNames: ['Január','Február','Marec','Apríl','Máj','Jún','Júl','August','September','Október','November','December'], // set month names
                              monthNamesShort: ['Jan','Feb','Mar','Apr','Mag','Jun','Jul','Aug','Sep','Okt','Nov','Dec'], // set short month names
                              dayNames: ['Pondelok','Utorok','Streda','Štvrtok','Piatok','Sobota','Nedeľa'], // set days names
                              dayNamesShort: ['Pon','Uto','Str','Štv','Pia','Sob','Ned'], // set short day names
                              dayNamesMin: ['PO','Ut','St','Št','Pi','So','Ne'], // set more short days names
                              dateFormat: 'dd.mm.yy' // set format date
                          };
                          $.datepicker.setDefaults( $.datepicker.regional['sk'] );

                          $( '#A006' ).datepicker();
                          $( '#A007' ).datepicker();
                        } );
