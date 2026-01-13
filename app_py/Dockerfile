FROM python:3.12

RUN apt update && apt upgrade -y && rm -rf /var/lib/apt/lists/*

WORKDIR /app

RUN mkdir database

COPY app/ .

RUN pip install --upgrade pip &&  pip install -r requirements.txt


CMD ["streamlit", "run", "app.py", "--server.port=8502"]
