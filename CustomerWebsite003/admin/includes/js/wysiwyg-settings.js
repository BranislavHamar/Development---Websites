/********************************************************************
 * openWYSIWYG settings file Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 *
 * $Id: wysiwyg-settings.js,v 1.4 2007/01/22 23:05:57 xhaggi Exp $
 ********************************************************************/

/*
 * Full featured setup used the openImageLibrary addon

var full = new WYSIWYG.Settings();
full.ImagesDir = "images/wisiwig_images/";
full.PopupsDir = "includes/html/popups/";
full.CSSFile = "includes/css/tpl_main_wisiwig.css";
full.Width = "100%"; 
full.Height = "300px";
// customize toolbar buttons
/*full.addToolbarElement("font", 3, 1); 
full.addToolbarElement("fontsize", 3, 2); 
full.addToolbarElement("headings", 3, 3); */

/*
 * Small Setup Example
 */
 
var small = new WYSIWYG.Settings();
small.Width = "100%";
small.Height = "400px";
small.DefaultStyle = "font-family: Verdana,Arial; font-size: 12px; background-color: #FFFFFF";
small.Toolbar[0] = new Array("headings", "seperator", "bold", "italic", "underline", "seperator", "undo", "redo", "seperator", "copy", "paste","inserttable","seperator","orderedlist","unorderedlist","removeformat"); // small setup for toolbar 1
small.Toolbar[1] = ""; // disable toolbar 2
small.StatusBarEnabled = false;
small.ImagesDir = "images/wisiwig_images/";
small.CSSFile = "includes/css/tpl_main_wisiwig.css";
small.PopupsDir = "includes/html/popups/";
small.InvertIELineBreaks = true; 

   WYSIWYG.attach('all',small);


