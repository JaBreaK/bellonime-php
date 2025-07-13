// resources/js/Layouts/MainLayout.jsx
import Navbar from '@/Components/Navbar'; // Gunakan alias @
// import Footer from '@/Components/Footer'; // Nanti bisa ditambahkan

export default function MainLayout({ children }) {
  return (
    <div className="bg-gray-950 text-gray-200 font-sans">
      <Navbar />
      <main className="min-h-screen">
        {children}
      </main>
      {/* <Footer /> */}
    </div>
  );
}