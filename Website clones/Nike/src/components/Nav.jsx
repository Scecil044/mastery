import { hamburger } from "../assets/icons";
import { headerLogo } from "../assets/images";
import { navLinks } from "../constants";

function Nav() {
  return (
    <header className="py-8 padding-x w-full z-10 absolute">
      <nav className="flex items-center justify-between max-container">
        <a href="/">
          <img src={headerLogo} alt="logo" width={130} height={29} />
        </a>
        <ul className="flex flex-1 gap-16 max-lg:hidden items-center justify-center">
          {navLinks.map((item) => (
            <li key={item.label}>
              <a
                href={item.href}
                className="text-lg text-slay-gray leading-normal"
              >
                {item.label}
              </a>
            </li>
          ))}
        </ul>
        <div className="hidden max-lg:block">
          <img src={hamburger} height={25} width={25} />
        </div>
      </nav>
    </header>
  );
}

export default Nav;
