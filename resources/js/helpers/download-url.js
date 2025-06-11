// In your helpers/download-url.js file
export const downloadDocument = async (filePath, toast = null) => {
    try {
        if (!filePath) {
            console.error("Path file tidak ditemukan.");
            if (toast) toast.error("File tidak tersedia");
            return false;
        }

        const fullUrl = `http://localhost:8000/${filePath}`;
        
        // Test if URL is accessible
        const testResponse = await fetch(fullUrl, { 
            method: 'HEAD',
            timeout: 5000 
        });

        if (!testResponse.ok) {
            throw new Error(`HTTP ${testResponse.status}`);
        }

        window.open(fullUrl, "_blank");
        return true;

    } catch (error) {
        console.error("Terjadi kesalahan saat mengunduh file:", error);
        
        if (toast) {
            if (error.message.includes('404')) {
                toast.error("File tidak ditemukan");
            } else if (error.message.includes('403')) {
                toast.error("Akses ditolak");
            } else {
                toast.error("Gagal mengunduh file");
            }
        }
        return false;
    }
};