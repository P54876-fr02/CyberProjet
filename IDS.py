import time
from scapy.all import *

blocked_ips = {}

def block_ip(ip_address):
    print("Blocking IP : " + ip_address)
    blocked_ips[ip_address] = time.time()

def is_blocked(ip_address):
    if ip_address in blocked_ips:
        if (time.time() - blocked_ips[ip_address]) <= 2:
            return True
        else:
            del blocked_ips[ip_address]
    return False

def packet_callback(packet):
    if packet.haslayer(TCP) and packet.haslayer(IP):
        src_ip = packet[IP].src
        if is_blocked(src_ip):
            return
        dst_port = packet[TCP].dport
        if dst_port in (80, 443):
            # Vérifier la charge utile du paquet pour la présence des chaînes de caractères "login" ou "password"
            if packet.haslayer(Raw):
                payload = str(packet[Raw].load).lower()
                if "login" in payload or "password" in payload:
                    block_ip(src_ip)
                    return

sniff(filter="tcp and ip", prn=packet_callback)