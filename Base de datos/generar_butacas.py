import sys

def generar_butacas(filas, columnas, sala): 
    for i in range(1, filas + 1): 
        for j in range(1, columnas + 1): 
            print(f"INSERT INTO Butaca (fila, columna, ID_Sala) VALUES ({i}, {j}, {sala}); ")

if __name__ == "__main__":
    generar_butacas(6,6,5)
    generar_butacas(7,5,7)
    generar_butacas(6,6,6)    
#generar_butacas(*[int(i) for i in sys.argv[1:]])