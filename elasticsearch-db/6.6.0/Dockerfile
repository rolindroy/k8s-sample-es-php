############################################################
# Dockerfile for elasticsearch
############################################################

# Using elasticsearch image
FROM docker.elastic.co/elasticsearch/elasticsearch:6.6.0

# Maintainer
MAINTAINER Rolind Roy

# Changing working Directory
WORKDIR /usr/share/elasticsearch

# Copying configuration files
COPY elasticsearch.yml ./config/elasticsearch.yml

# Setting up Environment variables
ENV MAINTAINER="Rolind Roy"
ENV ES_VERSION="6.6.0"
ENV CLUSTER_NAME="elasticsearch-production-cluster"
ENV NODE_NAME="elasticsearch-node-1"
ENV NODE_MASTER="true"
ENV NODE_INGEST="true"
ENV NODE_DATA="true"
ENV MAX_LOCAL_STORAGE_NODES=1
ENV NETWORK_HOST="_site_"
ENV MEMORY_LOCK="false"
ENV NUMBER_OF_MASTERS=1
ENV DISCOVERY_SERVICE="elasticsearch-discovery"
ENV ES_JAVA_OPTS="-Xms256m -Xmx256m"

# Creating Data and logs directory
RUN mkdir -p /data/{data,log}

# changing ownership for /data directory
RUN chown -R elasticsearch:elasticsearch /data

# Exposing both service and node ports
EXPOSE 9200 9300

# Starting elasticsearch service
CMD ["bin/elasticsearch"]
