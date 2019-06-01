class Acronym
  def self.abbreviate(words)
    words.scan(/\b\w/).join("").upcase
  end
end
