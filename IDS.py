import time
from scapy.all import *

blocked_ips = {}

max_request = 3

count = 0

#permet de bloquer l'ip suspecté
def block_ip(ip_address):
    print("Blocking IP : " + ip_address)
    blocked_ips[ip_address] = time.time()

# Fonction pour vérifier si une adresse IP est bloquée
def is_blocked(ip_address):
    if ip_address in blocked_ips:
        if (time.time() - blocked_ips[ip_address]) <= 2:
            return True
        else:
            del blocked_ips[ip_address]
    return False

#check les paquet donné et si le max de requête atteint alors on bloque l'ip 
def packet_callback(packet):
    if packet.haslayer(TCP) and packet.haslayer(IP):
        src_ip = packet[IP].src
        if is_blocked(src_ip): # Vérifie si l'adresse IP est déjà bloquée
            return
        dst_port = packet[TCP].dport
        if dst_port in (80, 443): # Vérifie si le port de destination est 80 ou 443 (HTTP ou HTTPS)
            # Vérifier la charge utile du paquet pour la présence des chaînes de caractères "login" ou "password"
            if packet.haslayer(Raw): # Vérifie s'il y a une charge utile dans le paquet
                payload = str(packet[Raw].load).lower() # Convertit la charge utile en minuscules pour faciliter la recherche
                if "login" in payload or "password" in payload:  # Vérifie la présence des mots "login" ou "password" dans la charge utile
                    block_ip(src_ip) # Bloque l'adresse IP en cas de correspondance
                    return

#une sonde mit dans le port 80 depuis l'interface ens33
sniff(filter="port 80", prn=packet_callback, iface="ens33", store=False)

