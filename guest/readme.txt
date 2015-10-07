This is a sample portal server that can be used in combination of UniFi controller
when you enable Guest Portal and select "External Portal Server".

Files:
  index.php           : the main login / term of use apge
  images/             : images
  authorized.php      : showing connecting in progress
  guest_authorized.sh : a shell script that tells UniFi controller to
                        authorize a specific client*
  readme.txt          : this file


The Flow of Guest Redirect and Authorization:
1. guest associates with an AP
2. guest goes to any website (e.g. http://www.google.com/) and redirected to
   the URL specified in the Customer Portal IP field (with two GET
   parameters. id: the MAC of the client, url: the URL the user intended to
   go)
3. index.php is served to the user and is the entry point where you can do 
   your customizations
4. once the guest is deem authorized, use an API to tell UniFi controller
   the MAC address of the client and how long it should be remain authorized
5. UniFi controller will notify the APs to pass traffic for these guests
6. authorized.php is where you show a brief redirecting message for
   controller to notify the APs and where to redirect the guest to (e.g.
   your promotional website)
7. When the authorization period is passed, it will notify the APs to 
   "unauthorize" the guest


Limitations:
- Before the guest is authorized, only traffic going to http://<ip>:80/ is allowed.
  (you may add more subnets to the allowed list at Settings->Guest Control)

* Note that this shell script contains the username/password to your UniFi
  controller for simplicity and may be downloadable if left at where it is.
  Make sure you move it somewhere else in production environments
