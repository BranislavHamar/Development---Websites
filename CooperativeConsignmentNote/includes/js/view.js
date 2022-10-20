
                  var interval;
                  var minutes = 0;
                  var seconds = 59;
                  window.onload = function() {
                      countdown('countdown');
                  }
              
                  function countdown(element) {
                      interval = setInterval(function() {
                          var el = document.getElementById(element);
                          if(seconds == 0) {
                              if(minutes == 0) {
                                  el.innerHTML = 'Refreshing page. Please wait...!';                    
                                  clearInterval(interval);
                                  return;
                              } else {
                                  minutes--;
                                  seconds = 60;
                              }
                          }
                          if(minutes > 0) {
                              var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
                          } else {
                              var minute_text = '';
                          }
                          var second_text = seconds > 1 ? 'seconds' : 'second';
                          el.innerHTML = 'Next page refresh in ' + minute_text + ' ' + seconds + ' ' + second_text + '.';
                          seconds--;
                      }, 1000);
                  }
