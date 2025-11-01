from fastapi import FastAPI
from app.api.endpoints import cabai

app = FastAPI()

app.include_router(cabai.router)