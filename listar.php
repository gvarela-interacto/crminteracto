<?php
/**
 * Listador de Carpetas
 * Script simple que lista todas las carpetas de primer nivel en una ruta
 */

class FolderLister {
    private $basePath;
    
    public function __construct($basePath) {
        $this->basePath = rtrim($basePath, '/');
        if (!is_dir($this->basePath)) {
            throw new Exception("La ruta especificada no existe: " . $this->basePath);
        }
    }
    
    /**
     * Lista todas las carpetas en el primer nivel
     */
    public function listFolders() {
        $folders = [];
        
        // Obtener todos los elementos del directorio
        $items = scandir($this->basePath);
        
        foreach ($items as $item) {
            // Excluir . y .. y verificar que sea un directorio
            if ($item !== '.' && $item !== '..' && is_dir($this->basePath . '/' . $item)) {
                $folders[] = $item;
            }
        }
        
        // Ordenar alfabéticamente
        sort($folders);
        
        return $folders;
    }
    
    /**
     * Muestra las carpetas en consola
     */
    public function displayFolders() {
        $folders = $this->listFolders();
        
        echo "=== CARPETAS ENCONTRADAS ===\n";
        echo "Ruta: " . $this->basePath . "\n";
        echo "Total de carpetas: " . count($folders) . "\n\n";
        
        if (empty($folders)) {
            echo "No se encontraron carpetas en esta ruta.\n";
        } else {
            foreach ($folders as $index => $folder) {
                echo ($index + 1) . ". " . $folder . "\n";
            }
        }
        
        return $folders;
    }
    
    /**
     * Obtiene información básica de cada carpeta
     */
    public function getFoldersInfo() {
        $folders = $this->listFolders();
        $foldersInfo = [];
        
        foreach ($folders as $folder) {
            $folderPath = $this->basePath . '/' . $folder;
            
            $info = [
                'name' => $folder,
                'path' => $folderPath,
                'size' => $this->getFolderSize($folderPath),
                'files_count' => $this->countFiles($folderPath),
                'last_modified' => date('Y-m-d H:i:s', filemtime($folderPath))
            ];
            
            $foldersInfo[] = $info;
        }
        
        return $foldersInfo;
    }
    
    /**
     * Muestra información detallada de las carpetas
     */
    public function displayDetailedInfo() {
        $foldersInfo = $this->getFoldersInfo();
        
        echo "=== INFORMACIÓN DETALLADA DE CARPETAS ===\n";
        echo "Ruta: " . $this->basePath . "\n";
        echo "Total de carpetas: " . count($foldersInfo) . "\n\n";
        
        foreach ($foldersInfo as $info) {
            echo "📁 " . $info['name'] . "\n";
            echo "   Ruta: " . $info['path'] . "\n";
            echo "   Archivos: " . $info['files_count'] . "\n";
            echo "   Tamaño: " . $this->formatBytes($info['size']) . "\n";
            echo "   Modificado: " . $info['last_modified'] . "\n";
            echo "\n";
        }
    }
    
    /**
     * Calcula el tamaño de una carpeta
     */
    private function getFolderSize($folderPath) {
        $size = 0;
        
        if (is_dir($folderPath)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            
            foreach ($files as $file) {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            }
        }
        
        return $size;
    }
    
    /**
     * Cuenta archivos en una carpeta
     */
    private function countFiles($folderPath) {
        $count = 0;
        
        if (is_dir($folderPath)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            
            foreach ($files as $file) {
                if ($file->isFile()) {
                    $count++;
                }
            }
        }
        
        return $count;
    }
    
    /**
     * Formatea bytes a formato legible
     */
    private function formatBytes($bytes) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;
        
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
    
    /**
     * Exporta la lista a un archivo JSON
     */
    public function exportToJson($filename = 'folders_list.json') {
        $foldersInfo = $this->getFoldersInfo();
        
        $jsonData = [
            'base_path' => $this->basePath,
            'scan_date' => date('Y-m-d H:i:s'),
            'total_folders' => count($foldersInfo),
            'folders' => $foldersInfo
        ];
        
        $json = json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $json);
        
        return $filename;
    }
    
    /**
     * Exporta la lista a un archivo CSV
     */
    public function exportToCsv($filename = 'folders_list.csv') {
        $foldersInfo = $this->getFoldersInfo();
        
        $csv = fopen($filename, 'w');
        
        // Escribir encabezados
        fputcsv($csv, ['Nombre', 'Ruta', 'Archivos', 'Tamaño (bytes)', 'Última modificación']);
        
        // Escribir datos
        foreach ($foldersInfo as $info) {
            fputcsv($csv, [
                $info['name'],
                $info['path'],
                $info['files_count'],
                $info['size'],
                $info['last_modified']
            ]);
        }
        
        fclose($csv);
        
        return $filename;
    }
}

// Ejemplo de uso
try {
    // Cambiar por la ruta que quieras analizar
    $lister = new FolderLister('librerias');
    
    // Opción 1: Lista simple
    echo "=== LISTA SIMPLE ===\n";
    $folders = $lister->displayFolders();
    
    echo "\n";
    
    // Opción 2: Lista con información detallada
    echo "=== LISTA DETALLADA ===\n";
    $lister->displayDetailedInfo();
    
    // Opción 3: Exportar a JSON
    $jsonFile = $lister->exportToJson();
    echo "Lista exportada a JSON: " . $jsonFile . "\n";
    
    // Opción 4: Exportar a CSV
    $csvFile = $lister->exportToCsv();
    echo "Lista exportada a CSV: " . $csvFile . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

// Función auxiliar para uso rápido
function listFolders($path) {
    try {
        $lister = new FolderLister($path);
        return $lister->listFolders();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        return [];
    }
}

// Ejemplo de uso rápido:
// $carpetas = listFolders('/mi/ruta');
// print_r($carpetas);
?>