#wizMarkdown

##Install it

1. `bower install wiz-markdown`
2. wizMarkdown requires `ngSanitize` so go ahead and add a script reference to `angular-sanitize.js`
3. Add `'wiz.markdown'` as a required module

Example:

    angular.module('myApp', [
      'wiz.markdown'
    ]);

##Use it

There are 4 options available to you with this plugin. In each example `mdText` is a `scope` variable that contains a markdown string.

###Display output using a directive

    <wiz-markdown content="mdText"></wiz-markdown>
    
> Q. Why can't you put content inside the directive?

> A. It's best to bind to the element so you don't get any pre-compile flashes of the page
    
###..or a filter

    <div ng-bind-html="mdText | wizMarkdownFltr"></div>
    
###..or a service

    <div ng-bind-html="mdText"></div>
    
    $scope.mdText = wizMarkdownSvc.Transform('#H1 heading');

##Editor

    <wiz-markdown-editor content="mdText"></wiz-markdown-editor>
    
The editor is essentially a textbox but it now has the ability to automatically format the markdown text via toolbar buttons.

###Toolbar

    <wiz-markdown-editor content="mdText">
        <wiz-toolbar-button command="bold">Bold</wiz-toolbar-button>
        <wiz-toolbar-button command="italic">Italic</wiz-toolbar-button>
    </wiz-markdown-editor>

The editor has a toolbar that you place buttons on by adding them inside the editor.

You can specify your own styling and content for each button.

The toolbar is positioned above the editor by default but if you specify `toolbar="bottom"` to the editor e.g. `<wiz-markdown-editor content="mdText" toolbar="bottom">` it will appear below.

###Available button commands

undo,
redo,
bold,
italic,
heading,
code,
ullist,
ollist,
indent,
outdent,
link,
img,
hr,
h0,
h1,
h2,
h3,
h4,
h5,
h6,
tab,
untab

##Textarea only
If you simply want a textarea without the toolbars then use:

    <wiz-markdown-input content="mdTextarea"></wiz-markdown-input>

##Syntax highlighting

[highlight.js](http://highlightjs.org/) is built in so all you need to do is pick a theme and drop the css link in the head of your webpage e.g.

    <link href="http://yandex.st/highlightjs/8.0/styles/github.min.css" rel="stylesheet" type="text/css">

Highlight.js website has a good [theme test page](http://highlightjs.org/static/test.html) that you should find useful.

##Play

Now have a play by downloading the zip and running the code ;-)

##Licence

wizMarkdown is covered by the MIT Licence

Copyright (c) 2014 Grumpy Wizards

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
