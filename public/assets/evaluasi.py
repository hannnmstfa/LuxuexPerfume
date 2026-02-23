import math

def luas_permukaan_kerucut(r, s):
    luas = math.pi * r**2 + math.pi * r * s
    return luas

r = 1249
s = 100

luas = luas_permukaan_kerucut(r, s)
print(f"Luas permukaan kerucut adalah: {luas:.2f}")
