# phpInsecureREST
Hacking together a basic modular REST API to drop into other projects


So, I know there are plenty of other PHP REST APIs, but it's better to learn how these things work by hand before using the tool. 

And hey, while I'm here I have gotten to learn how to make composer play nice, despite the absolutely impenetrable documentation. 

Oh boy. This project has crept some scope.

Ideally, this will set up the object(s) you're using in your projects, and calculates how to change the database in order to make it useful as more than a bucket for stuff.

The abstract class is going to end up absolutely terrible to behold, but you're gonna be able to just say "fuck it, I want a structure shaped like X", and the initialization is going to build the database, structure, map/reduce functions, and indices.

it won't *quite* perform as well as a SQL database for structured queries, but it'll be *great* at the user level, and exporting to SQL for structured analysis will be so easy.

