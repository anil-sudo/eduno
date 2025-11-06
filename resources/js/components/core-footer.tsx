import { Separator } from "@/components/ui/separator";
import { Button } from "@/components/ui/button";
import { Link } from "@inertiajs/react";
import AppLogo from "@/components/app-logo";

export default function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="w-full border-t bg-background text-foreground">
      <div className="container mx-auto px-4 py-10">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <div className="flex">
              <AppLogo />
            </div>
            <p className="text-sm text-muted-foreground mt-2">
              Your go-to platform for mastering Bachelor CS.
            </p>
          </div>

          <div>
            <h3 className="text-sm font-semibold mb-3">Quick Links</h3>
            <ul className="space-y-2 text-sm text-muted-foreground">
              <li>
                <Link href="/">
                  Home
                </Link>
              </li>
              <li>
                <Link href="/about" className="hover:text-foreground transition-colors">
                  About
                </Link>
              </li>
              <li>
                <Link href="/contact" className="hover:text-foreground transition-colors">
                  Contact
                </Link>
              </li>
            </ul>
          </div>

          <div>
            <h3 className="text-sm font-semibold mb-3">Stay Connected</h3>
            <div className="flex items-center space-x-2">
              <Button variant="outline" size="sm" asChild>
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer">
                  Twitter
                </a>
              </Button>
              <Button variant="outline" size="sm" asChild>
                <a href="https://github.com" target="_blank" rel="noopener noreferrer">
                  GitHub
                </a>
              </Button>
            </div>
          </div>
        </div>

        <Separator className="my-8" />

        <div className="flex flex-col md:flex-row justify-between text-sm text-muted-foreground">
          <p>© {currentYear} Eduno. All rights reserved.</p>
          <p>
            Made with <span className="text-red-500">♥</span> by Anil S.
          </p>
        </div>
      </div>
    </footer>
  )
}