/**
 * Simple ATTR
 */

 // jquery toggle whole attribute
  $.fn.toggleAttr = function(attr, val) {
    var test = $(this).attr(attr);
    if ( test ) {
      // if attrib exists with ANY value, still remove it
      $(this).removeAttr(attr);
    } else {
      $(this).attr(attr, val);
    }
    return this;
  };

  // jquery toggle just the attribute value
  $.fn.toggleAttrVal = function(attr, val1, val2) {
    var test = $(this).attr(attr);
    if ( test === val1) {
      $(this).attr(attr, val2);
      return this;
    }
    if ( test === val2) {
      $(this).attr(attr, val1);
      return this;
    }
    // default to val1 if neither
    $(this).attr(attr, val1);
    return this;
  };





// Dropdown menu lv 3
document.addEventListener("DOMContentLoaded", function () {
// make it as accordion for smaller screens
    if (window.innerWidth < 992) {

        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
          everydropdown.addEventListener('hidden.bs.dropdown', function () {
            // after dropdown is hidden, then find all submenus
              this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                // hide every submenu as well
                everysubmenu.style.display = 'none';
              });
          })
        });

        document.querySelectorAll('.dropdown-menu a').forEach(function(element){
          element.addEventListener('click', function (e) {
              let nextEl = this.nextElementSibling;
              if(nextEl && nextEl.classList.contains('submenu')) {
                // prevent opening link if link needs to open dropdown
                e.preventDefault();
                if(nextEl.style.display === 'block'){
                  nextEl.style.display = 'none';
                  console.log('open link 1');
                } else {
                  nextEl.style.display = 'block';
                  console.log('open link 2');
                }

              }
          });
        });


    }
// end if innerWidth
});


// end of Progress Loading
