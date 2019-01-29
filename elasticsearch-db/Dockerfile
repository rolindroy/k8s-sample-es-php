############################################################
# Dockerfile for elasticsearch
############################################################

# Using elasticsearch image
FROM docker.elastic.co/elasticsearch/elasticsearch:6.5.4@sha256:5ca85697b6273f63196b44c32311c5a2d1135af9cfd919e5922e49c5045d04b8

# Maintainer
MAINTAINER Rolind Roy

# Changing working Directory
WORKDIR /usr/share/elasticsearch

# Copying configuration files
COPY elasticsearch.yml ./config/elasticsearch.yml

# Exposing both service and node ports
EXPOSE 9200 9300

# Starting elasticsearch
CMD ["bin/elasticsearch"]
