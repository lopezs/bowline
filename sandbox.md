# Drupal 7 Installation with Docker and Fig

### Requirements
- [Git 2.0+](http://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
- [Docker 1.3+](https://docs.docker.com/installation/)
  - Docker service running.
  - Able to run docker command without sudo. (Need to fix this.)
- [Docker Compose](http://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/) (optional)
- A `workspace` directory in your home directory

### Step 1. Clone D7 into ~/workspace/PROJECT
Get the latest "integration" branch code for PROJECT. You will be able to work with this code base normally, as you would in any non-dockerized sandbox.

``` bash
cd ~/workspace
git clone REPOSITORY_URL PROJECT
cd PROJECT
```
NOTE: The rest of these commands run from the `~/workspace/PROJECT` directory.

TBD...