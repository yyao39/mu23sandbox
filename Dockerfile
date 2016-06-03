# Dockerfile extending the generic PHP image with application files for a
# single application.
FROM gcr.io/php-mvm-a/php-nginx:latest

# The Docker image will configure the document root according to this
# environment variable.
ENV DOCUMENT_ROOT /app
