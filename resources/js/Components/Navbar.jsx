// resources/js/Components/Navbar.jsx
import { Link } from '@inertiajs/react';

export default function Navbar() {
  const navLinks = [
    { href: "/ongoing", label: "Ongoing" },
    { href: "/completed", label: "Completed" },
    { href: "/schedule", label: "Jadwal" },
    { href: "/anime", label: "Daftar Anime" },
    { href: "/genres", label: "Genre" },
  ];

  return (
    <header className="bg-gray-900/80 backdrop-blur-sm sticky top-0 z-50 shadow-md border-b border-white/10">
      <nav className="container mx-auto px-4 py-3">
        <div className="flex justify-between items-center">
          {/* Logo / Brand Name */}
          <Link href="/" className="text-2xl font-bold text-white tracking-wider">
            Bellonime <span className="text-pink-500 text-xs">LARAVELxREACT</span>
          </Link>
          
          {/* Links Navigasi untuk Desktop */}
          <div className="hidden md:flex items-center gap-6 text-sm font-medium">
            {navLinks.map((link) => (
              <Link 
                key={link.href} 
                href={link.href} 
                className="text-gray-300 hover:text-pink-500 transition-colors"
              >
                {link.label}
              </Link>
            ))}
          </div>

          {/* Search Bar (placeholder) */}
          <div className="hidden sm:block">
            <input 
              type="text" 
              placeholder="Cari anime..." 
              className="px-3 py-2 text-sm text-white bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" 
            />
          </div>
        </div>
      </nav>
    </header>
  );
}