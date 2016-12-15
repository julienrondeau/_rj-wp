# _rj-wp
wordpress theme

_rj-wp is a wordpress theme developped by _rj

This theme is meant to be a wordpress parent theme. So use it to create a stunning wordpress child theme.
But feel free to use it as a normal wordpress theme.

_rj-wp is built using :
Bower to manage the dependencies : 
   - mappy-breakpoints (https://github.com/zellwk/mappy-breakpoints) : breakppoint mixin 
   - suzy (https://github.com/oddbird/susy) : the best layout grid system
   
Gulp for the workflow, with image sprites and compression, sass transformation, browsersync 
(see the gulpfile.js for more details)

To install the theme, use the classic wordpress theme install technic.
Create a child theme. 
_rj-wp automatically imports its style.css to the child theme. 

In bower.json and package.json, modify the name and the description of the project
To install the dependencies, in a terminal window, type :
npm install
bower install

Repo owner and admin : _rj (jul.rondeau@gmail.com)

