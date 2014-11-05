geodata-social-network
======================

Get geo data information about images from social networks.

You ask for a media file id, and this returns a list of venues, places, etc. of that location.

How use:
========

Clone this repo on your htdocs dir:

                    git clone https://github.com/cmarrero01/geodata-social-network.git

Then try this: http://localhost/geodata-social-network/api/media/ID_MEDIA_FILE

Also you can create a virtual host in your apache conf, and you can make request like this:

http://olapic.local/api/media/846589506938951701_12522773

Or if you want to use php build webservices, you can run on api folder:

                    php -S http://localhost:8000


Have Fun!!.