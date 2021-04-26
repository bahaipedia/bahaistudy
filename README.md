# Implementation plan

## Local environment<br>

- [X] Create steps, organize and visualize all possible views<br>
- [X] Create database schema and structure in local environment<br>
- [X] Create controller, route, and view organization structure>variable names, routes format, etc.<br>
- [X] Create database structure in local environment ( for testing )<br>
- [X] Create local-laravel environment<br>
- [X] Create developing structure<br>

## New overview, for the next steps, should be created-<br>

- [X] Implementation for each sector<br>
- [X] Create view<br>
- [X] Create controller and controller methods,<br>
- [X] Create routes<br>
- [X] Store implementation <br>
- [X] Updates implementation <br>
- [X] Deletes implementation <br>
- [X] Test and debug<br>
- [X] Feedback<br>
- [X] Clean data from database<br>

## Roles

- [ ] Determine roles types<br>
- [ ] Middlewares creation for this types<br>
- [ ] Testing<br>

## Group dashboard

- [X] Online status<br>
- [X] Realtime updates<br>
- [X] Chat implementation<br>
- [X] Users Interactions<br>

## Webapp config for admin role

- [ ] Recheck DB logic<br>
- [X] Create Views<br>
- [X] Updates and monitoring system<br>

## Final steps<br>

- [ ] Documentation for external consult<br>
- [ ] Apply layout, styles and design<br>
- [ ] Test with styles layout and design<br>

## Production environment and deployment

- [ ] Get AWS credentials<br>
- [ ] Create a EC2-Ubuntu instance<br>
- [ ] Install nginx<br>
- [ ] Install mysql<br>
- [ ] Migrate database schema<br>
- [ ] Migrate folder from local environment<br>
- [ ] Test in remote server<br>
- [ ] Support<br>

---

# Graphic design

## Brand identity

- [x] Logotype, brand colors and typography
- [x] Style Guide

## Design Layout

### Homepage

- [X] Menu Bar
  - [X] Logotype
  - [X] Menu items
  - [X] Account access (right justified)
- [X] Study group container (multiple, see ADMIN SETTINGS doc)
  - [X] Header
    - [X] Title of the container
    - [X] List/gallery toggle (right justified, See EXAMPLES below)
  - [X] Body of group container
    - List of groups, displayed in gallery or list mode<br>
      - Title, Image (only gallery view), Number of participants, Suggested times, View button<br>
      - Link to "Create a group"
  - [ ] Footer of group container
    - [ ] Link to "Search, filter or sort" (right justified, See "Expanded study group page")
  - [X] Footer
    - [x] Standard "Copyrights, Privacy Policy, etc."

### Expanded study group page

- [ ] [Menu bar](Menu-Bar)
- [ ] Search, filter and sort (see DEFINITIONS)
  - [ ] Search based on title
  - [ ] Filter based on Author or Suggested times
  - [ ] Sort based on details of the group, eg. creation time or number of participants
- [ ] Study group container (see "Homepage")
      Note: The container takes up 100% of screen real estate on this page
- [ ] Footer (see "Homepage")

- [ ] New study group form
- [ ] Joined Group
  - [ ] (Homepage) Description, participants and chatbox
- [ ] About
- [ ] Help
- [ ] Resources for hosts
- [ ] Materials

### View group page (User clicks "View" group from any page where groups are shown)

- [ ] Menu bar
- [ ] Group details container
  - [ ] Group title (see DEFINITIONS)
  - [ ] Group description (see DEFINITIONS)
  - [ ] Book image (see DEFINITIONS)
  - [ ] Suggested times (see DEFINITIONS)
  - [ ] Host comments (see DEFINITIONS)
  - [ ] Number of participants who have joined the group
  - [ ] Maximum group size (see DEFINITIONS)
  - [ ] "Share this group" with facebook/twitter/copy url links
- [ ] User is logged in:
  - [ ] "Join group" button shown
- [ ] User is not logged in:
  - [ ] "Create account & join" or "Login and join" options shown side by side.
- [ ] Footer

### View group page (for a user that has joined the group)

- [ ] Menu bar
- [ ] Group details container
- [ ] Group participants (see DEFINITIONS)
- [ ] Meeting url (see DEFINITIONS)
- [ ] Chat box (see DEFINITIONS)
- [ ] Footer

### View group page (for the Host)

- [ ] Menu bar
- [ ] Group details container
  - [ ] Options to edit any items the user could have defined during group creation process.
        Eg: Edit suggested times, or Edit Suggested group size, etc.
  - [ ] Option to close the group. No new members can join, meeting URL will become visible.
- [ ] Group participants
- [ ] Meeting url
  - [ ] Option to edit the url
- [ ] Chat box
- [ ] Footer

### Create group page (User must be logged in)

- [ ] Menu bar
- [ ] "Choose what to study" walkthrough (see EXAMPLES)
- [ ] Create group container (Group options)
  - [ ] Group title (may or may not be edited, see "Group title" under DEFINITIONS)
  - [ ] Group description (may or may not be edited, see "Group description" under DEFINITIONS)
  - [ ] Book image
  - [ ] Suggested times (required field)
    - [ ] Note: Users will need to be able to filter based on these options
  - [ ] Host comments (optional field)
  - [ ] Maximum group size (required field)
- [ ] Footer

### DEFINITIONS

* "Book image": This is an image of the book cover, admin defined. If no admin-defined image exists the system can use a default image.
* "Chat box": A place where all users in the group can talk with eachother. Users in the chat box should be identified by their username. Eg: "user1: some message here"
* "Group title": This represents what the group will be studying. If a user selects a book from a defined list of books the title/description will be fixed and the user cannot change it. Otherwise the user can set their own title/description.
* "Group description": This represents a description of what the group will be studying. See "Group title" above for when the user can or cannot change the description.
* "Group participants": This is a list of all people who have joined the group. Next to the users own name would be the button "Leave" to leave the group. View will have different options based on role:
  * User who is host: Username (Step down) [Option to stop being the group host, no leave option]
  * Other_user (remove) [Option to remove user from the group]
  * User in group (host exists): Username (Leave) [Option to leave group]
  * User in group (no host exists): Username (Leave|Become host)
* "Host comments": During the process of creating a new study group the system will ask the user to enter any comments specific to their group that will be shown on the "View group" page.
* "Maximum group size": During the process of creating a new study group the host can define the maximum number of users allowed to join the group.
* "Meeting url": This is a small section where the host can enter a URL that will represent the way in which the group will connect with eachother. Eg, a zoom URL. This URL should be visible only after the group has been closed.
* "Search, filter and sort": Search represents a free-text input box that searches group titles and descriptions. Filter reprents excluding study groups based on certain criteria to narrow the list of groups displayed to the user. Filter options should be "Author" and "Suggested times". Author here means author of the book the group will be studying. Sort means change the order that the groups are listed, based on criteria. Eg: Number of participants, highest to lowest (or visa versa). Date of group creation (Oldest to newest, or visa versa). Default order is oldest group is listed first.
* "Suggested times": Days and times that the group creator is available to study. Other users can filter by these settings.
  - Eg: "Filter to show me all study groups with Monday availabilty"

### EXAMPLES

Choose what to study walkthrough.
User selects from admin defined options, eg:
Writings of Author 1
Writings of Author 2
Writings of Author 3
It's something else
Next user selects a admin-defined book:
Book 1
Book 2
It's something else
Eg: User selects "Writings of Author 1, Book 1"
The user has selected an admin defined author and book. The author determines what container the study group will appear in. The book determines whether or not the user can edit certain fields like Title and description. In this case, those fields can not be edited.
Eg: User selects "Writings of Author 1, It's something else"
The study group will appear in the container designated for Author 1, but the user will have to add their own description and title. The book image can just be a default thumbnail.
Eg: User selects "It's something else" from the first step
The study group will appear in the container designated "Other" and the user will have to enter their own title and description.

Gallery view
See bahaistudy.group as that website currently shows the gallery view example
List view
Has: Title of the group (number of participants, other details of the group, join button) but no images
Eg:
_ Book 1 study group (3 participants, Suggested times..., Host: username) [View]
_ Book 2 study group (2 participants, Suggested times..., Host: username) [View] \* Book 3 study group (1 participants, Suggested times..., Host: username) [View]

## HTML & SCSS Notes

(...)

## Javascript Notes

### Form

- [ ] Make fields mandatory

(...)

## Other notes

- [ ] Responsive design
- [ ] Web manual
- [ ] Create a soft background in Done screen in p5js

## Texts

- [ ] You just created a study group message
