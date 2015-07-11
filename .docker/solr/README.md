# Docker drupal solr container

[![](https://badge.imagelayers.io/lopezs/drupal-solr:latest.svg)](https://imagelayers.io/?images=lopezs/drupal-solr:latest 'Get your own badge on imagelayers.io')

This image can be used as-is, it is based on [apachesolr](https://www.drupal.org/project/apachesolr) module   4.x configurations.

## Example Docker Compose configuration

```
solr:
  image: lopezs/drupal-solr
  hostname: solr
  ports:
    - "8983:8983"
  command: -Xmx1024m -DSTOP.PORT=8079 -DSTOP.KEY=stopkey -jar start.jar
```