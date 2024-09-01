# Use the base MySQL image
FROM mysql:5.7

# Set environment variables
ENV MYSQL_ROOT_PASSWORD=pass123
ENV MYSQL_DATABASE=fiaptpa

# Copy the initialization script to the container
COPY ./mysql-init/init.sql /docker-entrypoint-initdb.d/

# Expose the MySQL port
EXPOSE 3306
