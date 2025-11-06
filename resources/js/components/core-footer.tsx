import { Separator } from "@/components/ui/separator";
import { Button } from "@/components/ui/button";
import { Link } from "@inertiajs/react";
import AppLogo from "@/components/app-logo";
import ContactController from "@/actions/App/Http/Controllers/ContactController";
import PageController from "@/actions/App/Http/Controllers/PageController";

export default function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="w-full border-t bg-background text-foreground">
      <div className="container mx-auto px-4 py-12">
        <div className="grid grid-cols-1 gap-10 sm:grid-cols-2 md:grid-cols-3">
          <div className="space-y-3">
            <Link
              href={PageController.home.url()}
              className="flex items-center space-x-2"
            >
              <AppLogo />
            </Link>
            <p className="text-sm text-muted-foreground max-w-xs">
              Your go-to platform for mastering Bachelor CS.
            </p>
          </div>

          <div>
            <h3 className="text-sm font-semibold text-foreground mb-3 uppercase tracking-wide">
              Quick Links
            </h3>
            <ul className="space-y-2 text-sm text-muted-foreground">
              <li>
                <Link
                  href={PageController.home.url()}
                  className="hover:text-foreground transition-colors"
                >
                  Home
                </Link>
              </li>
              <li>
                <Link
                  href={PageController.about.url()}
                  className="hover:text-foreground transition-colors"
                >
                  About
                </Link>
              </li>
              <li>
                <Link
                  href={ContactController.create.url()}
                  className="hover:text-foreground transition-colors"
                >
                  Contact
                </Link>
              </li>
            </ul>
          </div>

          <div>
            <h3 className="text-sm font-semibold text-foreground mb-3 uppercase tracking-wide">
              Stay Connected
            </h3>
            <div className="flex flex-wrap items-center gap-2">
              <Button variant="outline" size="sm" asChild>
                <a
                  href="https://twitter.com"
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  Twitter
                </a>
              </Button>
              <Button variant="outline" size="sm" asChild>
                <a
                  href="https://github.com"
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  GitHub
                </a>
              </Button>
            </div>
          </div>
        </div>

        <Separator className="my-8" />

        <div className="flex flex-col md:flex-row items-center justify-between gap-2 text-sm text-muted-foreground">
          <p>© {currentYear} Eduno. All rights reserved.</p>
          <p className="text-center md:text-right">
            Made with <span className="text-red-500">♥</span> by{" "}
            <a
              href="https://stha-anil.com.np"
              target="_blank"
              rel="noopener noreferrer"
              className="hover:text-foreground font-medium transition-colors"
            >
              Anil S.
            </a>
          </p>
        </div>
      </div>
    </footer>
  );
}