import os
import time
import docker
import schedule

def execute_docker_logs(container_name, log_folder):
    client = docker.from_env()
    container = client.containers.get(container_name)
    
    logs = container.logs().decode("utf-8")
    
    log_file_path = os.path.join(log_folder, f"{container_name}_logs_{time.strftime('%Y%m%d%H%M%S')}.txt")
    
    with open(log_file_path, "w+") as log_file:
        log_file.write(logs)

def job():
    container_names = ["mutuelle", "hopital", "dmi-db-1", "dmi-front-1","dmi-php-1"]

    for container_name in container_names:
        log_folder = f"/logs/{container_name}-logs"
        execute_docker_logs(container_name, log_folder)

schedule.every(1).minutes.do(job)

while True:
    schedule.run_pending()
    time.sleep(1)
