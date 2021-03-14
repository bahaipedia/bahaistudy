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
git fecth
```

```bash
git merge -m"add your message" origin/main
```

( clean all merge conflict in this step )

- Now you can start working in your project
- For push use

```bash
git add .
```

```bash
git commit -m"use a informative message"
```

```bash
git push --set-upstream origin <nameofthebranch>
```

- Now in github page do the pull-request

- The main branch organize the conflict and decide
- The main branch do the pull