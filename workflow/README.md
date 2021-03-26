# Workflow guidline

## Source Control and Git

### For the workflow on git follow this guidelines for avoid source lost or source conflicts

- For layout, design, front-end use 'layout' branch	
- For controllers, routes, middleware use 'server' branch
- Follow this instructions allways when you start working in the project



```bash
git checkout -b <nameofthebranch>
```

```bash
git fetch
```

```bash
git merge -m"add your message" origin/main
```
( clean all merge conflict in this step )

- Now you can start working in your project
- For push repeat this steps, just in case

```bash
git fetch
```

```bash
git merge -m"add your message" origin/main
```
( clean all merge conflict in this step )

- And then

```bash
git add .
```

```bash
git commit -m"use a informative message"
```

```bash
git push --set-upstream origin <nameofthebranch>
```
prueba
- Now in github page do the pull-request

- The main branch organize the conflict and decide
- The main branch do the pull

## En caso de que salgan conflictos:

```bash
> PASO 1
git checkout -b <nameofthebranch>

> PASO 2
git fecth

> PASO 3
git merge -m"add your message" origin/main

!!!! ERROR Your local changes to the following files would be overwritten by merge:

> PASO 4
Open VSCode y resuelve los conflicts

git add .
git commit -m"Comentario"
git push --set-upstream origin layout
```


## Folders and files on the view and server

- There is a folder in the view called *dev*, this folder is for development and testing for the serve side
- For the front-end you can use for see the code, but try not modify them
- There is a folder called *bahai* this is for the actual website is a replica from the dev
- Also there is the /dev routes for the server testing and development, wich are the replica for the original routes 
