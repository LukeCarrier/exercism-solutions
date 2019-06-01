class Acronym
  def self.abbreviate(words)
    words.split(/[ -]/).map { |w| w[0] }.join("").upcase
  end
end
