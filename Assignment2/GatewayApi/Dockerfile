FROM python:3
COPY . /app
WORKDIR /app
RUN pip install -r requirements.txt
EXPOSE 2500
ENTRYPOINT [ "python" ]
CMD [ "apiserver.py" ]
