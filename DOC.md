In this document we can find all the instructions of how route, controllers and db schema interact.

Objects:

We have 4 main objects for this website.

- Users
- Authors
- Books
- Groups
- Containers
- Messages

The three is describe like this:

Container->Group->Authors->Books

Container contain many Groups.

Group contain many ( selected (AuthorsInContainers)) Authors

Authors contain many Books

Group contain also many Messages

Group contain one Host

Group contain a list of Users ( Group Participants )

Group have max participants size

Group have many available time ( AvailalbleTime ) ( not yet in front end )

Roles:

Admin role: this role can review logs, change users roles, create objects modify objects, delete objects. Also can host a group. Also can modify the General Website Configuration. Needs to have an account. Needs to verify email account.

Host role: this role can only create a group, also can host a group and modify only it own group. Needs to have an account. Needs or not to verify email account, depends on website configuration. 

Participant role: this role can only be part of groups, write and read messages, and explore groups. Needs to have an account. Don't need to verify email account

Guest role: this role only can view information of the groups.

Controllers:

We have 7 controllers files in order to separate main actions on the web site ( beside the Laravel Native AuthControllers ).

App/Http/Controllers/...

1. GeneralControllers ( the route name start with: )

This controller help us to organize the server logic for the main page (home, or landing)

2. ListController ( the route name start with: route(list.) ) 

This controller help us to return a list of the objects, it was implemented for developing the server side.

***All the methods of this controllers now deprecated because the front-end definitions.

3. StoreController ( the route name start with: route(store.) )

This controller help us to orginize the server logic for the Insert methods or Create methods for each one of the main Tables of our database.

***We have view return methods in this controller but are right now deprecated because the front-end definitions.

4. UpdateController ( the route name start with: route(update.) )

This controller help us to organize the server logic for the Update or Delete methods for each one of the main Tables of our databes.

5. GroupController ( the route name start with: route(group.) )

This controller help us to organize the server logic for all the actions involve in the management of the Groups object.

6. Managment

Also we have some Management Controllers for help us to achieve the File Managment and the Email Managment

6.1 FileController

This controller help us to organize the flow of the File Mangament ( conection with AWS S3 for the books images )

6.2 EmailController

This controller help us to orginze the flow of all the emails.

Note: The definition of this methods are in the commnets inside of the controller file

Routes.

We can find this routes in: Routes/Web.php

The routes names are defined in order to describe the controllers tree ( controller name. method first word. method second word )
Example: StoreController@bookPost -> route(store.book.post)
Note: the second name generally are the action defined

1. General Routes

We have welcome route that manage all the main or home view data.
We have Api Author for group creation
We have Api Book for group creation

2. List Routes. ( Deprecated )

This routes are defined by the name of the controller and the object. Ex: route(list.book) -> return the list of all books 

3. Store Routes 

This routes are defined by the name of the contrroler, the object and Post. Ex. route(store.book.post) -> this method are going to create a book
The other routes are for form propuse but right now is deprecated. The definition is the name of the controller and the name of the object. route(store.book)

4. Update Routes

This routes are defined by the name of the method (delete or update) the object and Post. Ex route(update.book.post) or route(update.book.delete)

5. Group Routes

We have one Get route wi is the dashboard or the principal group view, it is defined by route(group.dashboard)
The others routes are 'actions' routes and is defined by the name of the controller, and the action. Ex. route(group.join)

6. Api Routes

The last routes are 'api' routes. The api routes in this website are routes that was defined to help us to interact directly with the front-end with ajax methods.
We have this in the general, update, and group

7. Auth Routes

Some of this routes are Laravel predefined in order to achieve security and user consistent.
Other was implemented in order to some actions like disable user account, email verification, role management.

Database Structure:

The definitions of the database tables and fields are in the dbstructure.xlsx, also in the database schema itself.