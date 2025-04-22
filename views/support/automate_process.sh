#!/bin/bash

# Define paths to your PHP scripts
GET_USERS_SCRIPT="../support/obtener_usuarios_pendientes.php"
SEND_EMAILS_SCRIPT="../support/enviar_correos.php"

# Ejecutar el script para obtener usuarios pendientes
echo "Ejecutando obtener_usuarios_pendientes.php..."
GET_USERS_OUTPUT=$(php "$GET_USERS_SCRIPT")

# Verificar si la ejecución fue exitosa
if [ $? -eq 0 ]; then
    echo "Usuarios pendientes obtenidos con éxito."
else
    echo "Error al obtener usuarios pendientes."
    echo "$GET_USERS_OUTPUT"
    exit 1
fi

# Ejecutar el script para enviar correos
echo "Ejecutando enviar_correos.php..."
SEND_EMAILS_OUTPUT=$(php "$SEND_EMAILS_SCRIPT")

# Verificar si la ejecución fue exitosa
if [ $? -eq 0 ]; then
    echo "Correos enviados con éxito."
else
    echo "Error al enviar correos."
    echo "$SEND_EMAILS_OUTPUT"
    exit 1
fi

echo "Proceso completado."
