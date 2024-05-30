from fastapi import FastAPI, APIRouter, Depends, HTTPException, Response
from starlette.status import HTTP_201_CREATED, HTTP_401_UNAUTHORIZED
from sqlalchemy import text 
from sqlalchemy.orm import Session
from database.db import conn
from models.models import clientes, mascotas
from schemas.schemas import ClienteSchema, CredencialesSchema, MascotaSchema
from passlib.context import CryptContext
from pydantic import BaseModel
from cryptography.fernet import Fernet
from fastapi.responses import JSONResponse

key = Fernet.generate_key()
Fernet(key)
f = Fernet(key)

router_cliente = APIRouter()
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")


@router_cliente.post("/register/client")
def registrar_cliente(cliente: ClienteSchema):
    #with engine.connect() as conn:
    new_client = cliente.dict()
    #new_client["clave"] = f.encrypt(cliente.clave.encode("utf-8"))
    result = conn.execute(clientes.insert().values(new_client))
    conn.commit()
    print(result)
    return Response(status_code=HTTP_201_CREATED)

@router_cliente.post('/login/client')
def login_cliente(credenciales: CredencialesSchema):
    query = text(f"SELECT id_cliente, nombre, clave FROM cliente WHERE email = :email")
    result = conn.execute(query, {"email": credenciales.email}).fetchone()
    
    if not result:
        raise HTTPException(status_code=404, detail="Usuario no encontrado")
    
    id_cliente, nombre, clave = result

    if credenciales.clave != clave:
        raise HTTPException(status_code=401, detail="Credenciales inválidas")

    return JSONResponse(content={"id_cliente": id_cliente, "nombre": nombre}, status_code=200)


@router_cliente.post("/register/mascota")
def registrar_mascota(mascota: MascotaSchema):
    #with engine.connect() as conn:
    nueva_mascota = mascota.dict()
    result = conn.execute(mascotas.insert().values(nueva_mascota))
    conn.commit()
    print(result)
    return Response(status_code=HTTP_201_CREATED)