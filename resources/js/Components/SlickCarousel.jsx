// resources/js/Components/SlickCarousel.jsx
import Slider from "react-slick";
import AnimeCard from "./AnimeCard";

export default function SlickCarousel({ animes }) {
  const settings = {
    dots: false,
    infinite: false,
    speed: 500,
    slidesToShow: 7,
    slidesToScroll: 4,
    responsive: [
        { breakpoint: 1280, settings: { slidesToShow: 6, slidesToScroll: 3 } },
        { breakpoint: 1024, settings: { slidesToShow: 5, slidesToScroll: 3 } },
        { breakpoint: 768,  settings: { slidesToShow: 4, slidesToScroll: 2 } },
        { breakpoint: 640,  settings: { slidesToShow: 3, slidesToScroll: 2 } },
        { breakpoint: 475,  settings: { slidesToShow: 2, slidesToScroll: 2 } }
    ]
  };

  return (
    <div className="w-full -mx-2">
      <Slider {...settings}>
        {animes.map((anime) => (
          <div key={anime.animeId} className="px-2 py-4">
            <AnimeCard anime={anime} />
          </div>
        ))}
      </Slider>
    </div>
  );
}