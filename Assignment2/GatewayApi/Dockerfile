FROM ubuntu:16.04
RUN apt-get update -y && \
    apt-get install -y python-pip python-dev

# We copy just the requirements.txt first to leverage Docker cache
COPY ./requirements.txt /appapi/requirements.txt

WORKDIR /appapi

RUN pip install -r requirements.txt

COPY . /appapi

ENTRYPOINT [ "python" ]

CMD [ "pyserver.py" ]